<?php
/**
 * Copyright © 2016 GBKSOFT. Web and Mobile Software Development.
 * See LICENSE.txt for license details.
 */
namespace dell\stripe;

use yii\base\BootstrapInterface;

/**
 * Class Module
 */
class Module extends \yii\base\Module implements BootstrapInterface
{
    const MODULE_ID = 'stripe';

    const MODE_LIVE = 'live';
    const MODE_TEST = 'test';

    /**
     * @var string
     */
    public $apiPublicKey;

    /**
     * @var string
     */
    public $apiSecretKey;

    /**
     * @var string
     */
    public $mode;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        // initialize the module with the configuration loaded from main.php
        \Yii::configure($this, require(__DIR__ . '/config/main.php'));

        if ($this->mode === null) {
            $this->mode = static::MODE_TEST;
        }
    }

    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        \Yii::setAlias('@stripe', __DIR__);
    }
}
