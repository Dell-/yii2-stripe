<?php
/**
 * Copyright © 2016 GBKSOFT. Web and Mobile Software Development.
 * See LICENSE.txt for license details.
 */
namespace dell\stripe\models\stripe;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Class Transaction
 *
 * @property int $id
 * @property string $uid
 * @property int $order_id
 * @property int $customer_id
 * @property string $mode
 * @property int $type
 * @property int $status
 * @property int $amount
 * @property string $description
 * @property string $data
 * @property int $created_at
 */
class Transaction extends ActiveRecord
{
    const MODE_LIVE = 'live';
    const MODE_TEST = 'test';

    const TYPE_CHARGE = 1;

    const STATUS_SUCCEEDED = 11;
    const STATUS_PENDING = 22;
    const STATUS_FAILED = 33;

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
                    'order_id',
                    'customer_id',
                    'amount',
                    'data',
                ],
                'require'
            ],
            [['id', 'order_id', 'customer_id', 'amount'], 'integer'],
            [['uid', 'description', 'data'], 'string'],
            ['mode', 'in', 'range' => [static::MODE_LIVE, static::MODE_TEST]],
            ['type', 'in', 'range' => [static::TYPE_CHARGE]],
            ['status', 'in', 'range' => [static::STATUS_SUCCEEDED, static::STATUS_PENDING, static::STATUS_FAILED]],
        ];
    }
}
