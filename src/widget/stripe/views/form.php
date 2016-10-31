<?php
/**
 * Copyright © 2016 GBKSOFT. Web and Mobile Software Development.
 * See LICENSE.txt for license details.
 */
use dell\stripe\models\card\Form;
use dell\stripe\Module;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var Form $card
 */

$this->registerJs(
    'Stripe.setPublishableKey("' . \Yii::$app->getModule(Module::MODULE_ID)->apiPublicKey . '");'
);

$js = <<< JS
$(function() {
    $('#payment-form').on('submit', function (event) {
        
        window.Stripe.card.createToken(form, function (status, response) {
             //
        });
    
        return false;
    });
});
JS;

$this->registerJs($js);

?>

<?php $form = ActiveForm::begin([
    'id' => 'payment-form',
    'action' => \yii\helpers\Url::to('stripe/payment/charge'),
]); ?>
    <?php echo $form->field($card, 'number')->input('text'); ?>

    <?php echo $form->field($card, 'exp_month')->input('text'); ?>

    <?php echo $form->field($card, 'exp_year')->input('text'); ?>

    <?php echo $form->field($card, 'cvc')->input('text'); ?>

    <?php echo Html::submitButton('Pay', ['id' => 'submit-button']); ?>
<?php
ActiveForm::end();
