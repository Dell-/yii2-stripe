<?php
/**
 * Copyright © 2016 GBKSOFT. Web and Mobile Software Development.
 * See LICENSE.txt for license details.
 */
namespace dell\stripe;

/**
 * Class Module
 */
class Module extends \yii\base\Module
{
    const MODULE_ID = 'stripe';

    /**
     * @var string
     */
    public $apiKey;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        // initialize the module with the configuration loaded from config.php
        \Yii::configure($this, require(__DIR__ . '/config/main.php'));
    }
}
