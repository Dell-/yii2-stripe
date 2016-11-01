<?php
/**
 * Copyright © 2016 GBKSOFT. Web and Mobile Software Development.
 * See LICENSE.txt for license details.
 */
namespace dell\stripe\widget\stripe;

use dell\stripe\common\stripe\user\Service;
use dell\stripe\widget\stripe\assets\StripeAssets;
use yii\base\Widget;

/**
 * Class Form
 */
class Form extends Widget
{
    /**
     * @var string
     */
    public $template = 'form';

    /**
     * @var array
     */
    public $params = [];

    /**
     * @var Service
     */
    private $service;

    /**
     * Form constructor
     *
     * @param Service $service
     * @param array $config
     */
    public function __construct(
        Service $service,
        array $config = []
    ) {
        parent::__construct($config);
        $this->service = $service;
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        StripeAssets::register($this->getView());
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $this->params['service'] = $this->service;

        return $this->render($this->template, $this->params);
    }
}
