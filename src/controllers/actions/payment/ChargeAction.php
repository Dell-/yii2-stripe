<?php
/**
 * Copyright © 2016 GBKSOFT. Web and Mobile Software Development.
 * See LICENSE.txt for license details.
 */
namespace dell\stripe\controllers\actions\payment;

use yii\base\Action;

/**
 * Class ChargeAction
 */
class ChargeAction extends Action
{
    public function run()
    {
        print_r(\Yii::$app->getRequest()->post('token')); die;
    }
}
