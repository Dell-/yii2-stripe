<?php
/**
 * Copyright © 2016 GBKSOFT. Web and Mobile Software Development.
 * See LICENSE.txt for license details.
 */
namespace dell\stripe\models\card;

use yii\base\Model;

/**
 * Class Form
 */
class Form extends Model
{
    public $number;
    public $exp_month;
    public $exp_year;
    public $cvc;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number', 'exp_month', 'exp_year', 'cvc'], 'required'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'number' => 'Card Number',
            'exp_month' => 'Month',
            'exp_year' => 'Year',
            'cvc' => 'CVC',
        ];
    }
}
