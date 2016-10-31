<?php
/**
 * Copyright © 2016 GBKSOFT. Web and Mobile Software Development.
 * See LICENSE.txt for license details.
 */
namespace gbksoft\stripe\controllers;

use gbksoft\stripe\controllers\actions\payment\ChargeAction;
use yii\web\Controller;

/**
 * Class PaymentController
 */
class PaymentController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'charge' => [
                'class' => ChargeAction::class
            ]
        ];
    }
}
