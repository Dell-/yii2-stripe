<?php
/**
 * Copyright © 2016 GBKSOFT. Web and Mobile Software Development.
 * See LICENSE.txt for license details.
 */
namespace dell\stripe\controllers\actions\payment;

use dell\stripe\common\stripe\Client;
use dell\stripe\models\stripe\Transaction;
use yii\base\Action;
use yii\base\DynamicModel;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

/**
 * Class ChargeAction
 */
class ChargeAction extends Action
{
    /**
     * @var Client
     */
    private $client;

    /**
     * ChargeAction constructor.
     *
     * @param string $id
     * @param Controller $controller
     * @param Client $client
     * @param array $config
     */
    public function __construct(
        $id,
        Controller $controller,
        Client $client,
        array $config = []
    ) {
        parent::__construct($id, $controller, $config);
        $this->client = $client;
    }

    /**
     * Charge action
     */
    public function run()
    {
        $type = \Yii::$app->getRequest()->post('type');
        $token = \Yii::$app->getRequest()->post('token');
        $clientIp = \Yii::$app->getRequest()->post('client_ip');
        $email = \Yii::$app->getRequest()->post('email');

        $this->client->setScenario(Client::SCENARIO_CREATE_CUSTOMER);
        $this->client->setAttributes(
            [
                'type' => $type,
                'token' => $token,
                'clientIp' => $clientIp,
                'email' => $email,
            ]
        );

        $customer = $this->client->createCustomer();

        if (!$customer) {
            throw new BadRequestHttpException('Sorry, this transaction has been declined, try again later.');
        }

        $transaction = $this->client->charge($customer);

        if (!$transaction) {
            throw new BadRequestHttpException('Sorry, this transaction has been declined, try again later.');
        }

        $model = new DynamicModel($transaction->getAttributes());

        $model->addRule(['status'], function () use ($model) {
            if ($model->status !== Transaction::STATUS_SUCCEEDED) {
                $model->addError('status', 'Wrong status.');
            }
        })->validate();

        if ($model->hasErrors()) {
            throw new BadRequestHttpException('Sorry, this transaction has been declined, try again later.');
        }
    }
}
