<?php
/**
 * Copyright © 2016 GBKSOFT. Web and Mobile Software Development.
 * See LICENSE.txt for license details.
 */
use dell\stripe\Module;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 */

$this->registerJsFile('https://checkout.stripe.com/checkout.js');

echo Html::button('Pay', ['id' => 'stripe-button']);

$url = \yii\helpers\Url::to('stripe/payment/charge');
$key = \Yii::$app->getModule(Module::MODULE_ID)->apiPublicKey;

$js = <<< JS
var handler = StripeCheckout.configure({
  key: '{$key}',
  image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
  locale: 'auto',
  token: function(token) {
    console.log(token);
    $.post('{$url}', {token: token.id}, function(response) {
        console.log(response);
    });
  }
});

document.getElementById('stripe-button').addEventListener('click', function(e) {
  // Open Checkout with further options:
  handler.open({
    name: 'Demo Site',
    description: '2 widgets',
  });
  e.preventDefault();
});

// Close Checkout on page navigation:
window.addEventListener('popstate', function() {
  handler.close();
});
JS;

$this->registerJs($js);
