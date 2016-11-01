<?php
/**
 * Copyright © 2016 GBKSOFT. Web and Mobile Software Development.
 * See LICENSE.txt for license details.
 */
namespace dell\stripe\common\stripe;

use dell\stripe\common\stripe\transaction\Builder as TransactionBuilder;
use dell\stripe\common\stripe\card\address\Builder as AddressBuilder;
use dell\stripe\common\stripe\card\Builder as CardBuilder;
use dell\stripe\common\stripe\customer\Builder as CustomerBuilder;
use dell\stripe\common\stripe\user\Service;
use dell\stripe\models\stripe\Customer;
use dell\stripe\models\stripe\Transaction;
use dell\stripe\Module;
use Stripe\Stripe;
use yii\base\Model;

/**
 * Class Client
 */
class Client extends Model
{
    const SCENARIO_CREATE_CUSTOMER = 'create-customer';

    const TYPE_CARD = 'card';

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $token;

    /**
     * @var string
     */
    public $clientIp;

    /**
     * @var string
     */
    public $email;

    /**
     * @var Service
     */
    private $service;

    /**
     * @var string
     */
    private $mode;

    /**
     * @var CardBuilder
     */
    private $cardBuilder;

    /**
     * @var CustomerBuilder
     */
    private $customerBuilder;

    /**
     * @var AddressBuilder
     */
    private $addressBuilder;

    /**
     * @var TransactionBuilder
     */
    private $transactionBuilder;

    /**
     * Client constructor
     *
     * @param TransactionBuilder $transactionBuilder
     * @param AddressBuilder $addressBuilder
     * @param CustomerBuilder $customerBuilder
     * @param CardBuilder $cardBuilder
     * @param Service $service
     * @param array $config
     */
    public function __construct(
        TransactionBuilder $transactionBuilder,
        AddressBuilder $addressBuilder,
        CustomerBuilder $customerBuilder,
        CardBuilder $cardBuilder,
        Service $service,
        array $config = []
    ) {
        parent::__construct($config);
        $this->service = $service;
        $this->cardBuilder = $cardBuilder;
        $this->customerBuilder = $customerBuilder;
        $this->addressBuilder = $addressBuilder;
        $this->transactionBuilder = $transactionBuilder;
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->mode = \Yii::$app->getModule(Module::MODULE_ID)->mode;
        Stripe::setApiKey(\Yii::$app->getModule(Module::MODULE_ID)->apiSecretKey);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['token', 'required', 'on' => static::SCENARIO_CREATE_CUSTOMER],
            ['type', 'in', 'range' => [static::TYPE_CARD], 'strict' => true, 'on' => static::SCENARIO_CREATE_CUSTOMER],
            ['clientIp', 'ip', 'on' => static::SCENARIO_CREATE_CUSTOMER],
            ['email', 'email', 'on' => static::SCENARIO_CREATE_CUSTOMER],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[static::SCENARIO_CREATE_CUSTOMER] = ['token', 'type', 'clientIp', 'email'];

        return $scenarios;
    }

    /**
     * @param Customer $customer
     * @return bool|Transaction
     */
    public function charge(Customer $customer)
    {
        if (!$this->validate()) {
            return false;
        }

        $user = $this->service->getCurrentUser();
        $order = $user->getOrder();

        $stripeCharge = \Stripe\Charge::create(
            [
                'amount' => $order->getTotalPrice() * 100,
                'currency' => strtolower($order->getCurrency()),
                'source' => $customer->getSelectedSource()->uid,
                'description' => 'Charge for ' . $customer->email,
                'metadata' => [
                    'order_id' => $order->getId(),
                    'user_id' => $user->getId(),
                ],
                'receipt_email' => $customer->email,
                'customer' => $customer->uid,
            ]
        );

        if (!$stripeCharge) {
            $this->addError('toke', 'Wrong token.');
            return false;
        }

        $transaction = $this->transactionBuilder->setMode($this->mode)
            ->setCustomerId($customer->id)
            ->setTransaction($stripeCharge)
            ->setType(Transaction::TYPE_CHARGE)
            ->build();

        $transaction->save();

        return $transaction->save() ? $transaction : false;
    }

    /**
     * @return bool|Customer
     */
    public function createCustomer()
    {
        if (!$this->validate()) {
            return false;
        }

        $transaction = Customer::getDb()->beginTransaction();

        try {
            $user = $this->service->getCurrentUser();

            $stripeCustomer = \Stripe\Customer::create([
                'description' => 'Customer for ' . $user->getEmail(),
                'source' => $this->token
            ]);

            if (!$stripeCustomer) {
                $this->addError('toke', 'Wrong token.');
            }

            $customer = $this->customerBuilder->setMode($this->mode)
                ->setCustomer($stripeCustomer)
                ->setEmail($this->email)
                ->setUserId($user->getId())
                ->build();

            if (!$customer->save()) {
                $transaction->rollBack();
                return false;
            }

            foreach ($stripeCustomer->sources->data as $stripeSource) {
                if ($stripeSource instanceof \Stripe\Card) {

                    $source = $this->cardBuilder->setCard($stripeSource)
                        ->setCustomerId($customer->id)
                        ->setIsDefault($stripeSource->id === $stripeCustomer->default_source)
                        ->setMode($this->mode)
                        ->build();

                    if (!$source->save()) {
                        $transaction->rollBack();
                        return false;
                    }

                    $customer->setSelectedSource($source);

                    $address = $this->addressBuilder->setMode($this->mode)
                        ->setCustomerId($customer->id)
                        ->setCard($stripeSource)
                        ->setCardId($source->id)
                        ->build();

                    if (!$address->save()) {
                        $transaction->rollBack();
                        return false;
                    }
                }
            }

            $transaction->commit();

            return $customer;
        } catch (\Exception $exception) {
            $transaction->rollBack();
        }

        return false;
    }
}
