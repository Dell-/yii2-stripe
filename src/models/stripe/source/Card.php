<?php
/**
 * Copyright © 2016 GBKSOFT. Web and Mobile Software Development.
 * See LICENSE.txt for license details.
 */
namespace dell\stripe\models\stripe\source;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Class Card
 *
 * @property int $id
 * @property string $uid
 * @property int $customer_id
 * @property string $mode
 * @property string $brand
 * @property string $funding
 * @property string $country
 * @property int $exp_month
 * @property int $exp_year
 * @property string $last4
 * @property string $data
 * @property int $created_at
 */
class Card extends ActiveRecord
{
    const MODE_LIVE = 'live';
    const MODE_TEST = 'test';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => false
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'uid',
                    'customer_id',
                    'brand',
                    'funding',
                    'country',
                    'exp_month',
                    'exp_year',
                    'last4',
                ],
                'require'
            ],
            [['id', 'customer_id', 'exp_month', 'exp_year'], 'integer'],
            [['uid', 'brand', 'funding', 'country', 'last4', 'data'], 'string'],
            ['mode', 'in', 'range' => [static::MODE_LIVE, static::MODE_TEST]],
        ];
    }
}
