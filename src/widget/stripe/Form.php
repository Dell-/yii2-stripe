<?php
/**
 * Copyright © 2016 GBKSOFT. Web and Mobile Software Development.
 * See LICENSE.txt for license details.
 */
namespace dell\stripe\widget\stripe;

use dell\stripe\widget\stripe\assets\StripeAssets;
use yii\base\Widget;

/**
 * Class Form
 */
class Form extends Widget
{
    public $template = 'form';

    public $params = [];

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
        return $this->render($this->template, $this->params);
    }
}
