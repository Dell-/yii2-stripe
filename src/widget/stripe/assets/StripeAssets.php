<?php
/**
 * Copyright © 2016 GBKSOFT. Web and Mobile Software Development.
 * See LICENSE.txt for license details.
 */
namespace dell\stripe\widget\stripe\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Class StripeAssets
 */
class StripeAssets extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public static function register($view)
    {
        $view->registerJsFile('https://js.stripe.com/v2/', ['position' => View::POS_HEAD]);

        return parent::register($view);
    }
}
