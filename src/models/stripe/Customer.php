<?php
/**
 * Copyright © 2016 GBKSOFT. Web and Mobile Software Development.
 * See LICENSE.txt for license details.
 */
namespace dell\stripe\models\stripe;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Class Customer
 *
 * @property int $id
 * @property string $uid
 * @property int $user_id
 * @property string $mode
 * @property int $default_source_id
 * @property string $email
 * @property string $description
 * @property string $currency
 * @property int $created_at
 * @property int $updated_at
 */
class Customer extends ActiveRecord
{
    const MODE_LIVE = 'live';
    const MODE_TEST = 'test';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'user_id', 'default_source_id', 'email', 'currency'], 'require'],
            [['id', 'user_id', 'default_source_id'], 'integer'],
            [['uid', 'currency', 'description'], 'string'],
            ['email', 'email'],
            ['mode', 'in', 'range' => [static::MODE_LIVE, static::MODE_TEST]],
        ];
    }
}
