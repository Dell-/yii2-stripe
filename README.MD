Stripe integration for Yii2
=====

- [Documentation](https://stripe.com/docs)
- [PHP Client](https://github.com/stripe/stripe-php)

### Configuration
```php
<?php
// @console
return [
    // ....
    'bootstrap' => [\dell\stripe\Module::MODULE_ID],
    // ....
    'modules' => [
        // ....
        \dell\stripe\Module::MODULE_ID => [
            'class' => \dell\stripe\Module::class
        ],
    ],
    // ....
];

// @frontend
return [
    // ....
    'modules' => [
        \dell\stripe\Module::MODULE_ID => [
            'class' => \dell\stripe\Module::class,
            'apiPublicKey' => 'pk_xxxx_xxxxxxxxxxxxxxxxxxxxxxxx',
            'apiSecretKey' => 'sk_xxxx_xxxxxxxxxxxxxxxxxxxxxxxx',
        ],
    ],
    // ....
];

```

### Migrations
```sh
./yii migrate --migrationPath='@stripe/migrations'
```

### Form integration
```php
<?php echo \dell\stripe\widget\stripe\Form::widget([
    'template' => 'form',
    'params' => ['card' => new \dell\stripe\models\card\Form()]
]); ?>
```

### Or button integration
```php
<?php echo \dell\stripe\widget\stripe\Form::widget([
    'template' => 'button',
]); ?>
```
