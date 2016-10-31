<?php
/**
 * Copyright © 2016 GBKSOFT. Web and Mobile Software Development.
 * See LICENSE.txt for license details.
 */
namespace common\stripe;

use gbksoft\stripe\Module;
use Stripe\Stripe;

/**
 * Class Client
 */
class Client
{
    /**
     * Client constructor
     */
    public function __construct()
    {
        Stripe::setApiKey(\Yii::$app->getModule(Module::MODULE_ID)->apiKey);
    }

    public function charge()
    {
        $charge = \Stripe\Charge::create();


    }
}
