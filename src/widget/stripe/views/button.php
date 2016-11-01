<?php
/**
 * Copyright © 2016 GBKSOFT. Web and Mobile Software Development.
 * See LICENSE.txt for license details.
 */
use dell\stripe\common\stripe\user\OrderInterface;
use dell\stripe\common\stripe\user\Service;
use dell\stripe\Module;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var string $name
 * @var string $description
 * @var OrderInterface $order
 * @var Service $service
 */

$user = $service->getCurrentUser();
$order = $user->getOrder();

$this->registerJsFile('https://checkout.stripe.com/checkout.js');

echo Html::button(
    'Pay - ' . $order->getTotalPrice() . ' ' . $order->getCurrency(),
    ['id' => 'stripe-button']
);

$url = \yii\helpers\Url::to('stripe/payment/charge');
$key = \Yii::$app->getModule(Module::MODULE_ID)->apiPublicKey;

$js = <<< JS
var handler = StripeCheckout.configure({
    key: '{$key}',
    image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
    locale: 'auto',
    token: function(token) {
        console.log(token);
        $.post(
            '{$url}',
            {
                type: token.type,
                token: token.id,
                client_ip: token.client_ip,
                email: token.email
            },
            function(response) {
                if (response.url) {
                    window.location = response.url;
                    return;
                }
                window.location.reload();
        });
    }
});

document.getElementById('stripe-button')
    .addEventListener('click', function(e) {
        handler.open({
            name: '{$name}',
            description: '{$description}',
            billingAddress: true
        });
        e.preventDefault();
    });

// Close Checkout on page navigation:
window.addEventListener('popstate', function() {
    handler.close();
});
JS;

$this->registerJs($js);
