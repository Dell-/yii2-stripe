<?php
/**
 * Copyright © 2016 GBKSOFT. Web and Mobile Software Development.
 * See LICENSE.txt for license details.
 */
namespace dell\stripe\models\stripe\source\card;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Class Address
 *
 * @property int $id
 * @property int $customer_id
 * @property string $uid
 * @property string $city
 * @property string $country
 * @property string $line1
 * @property string $line2
 * @property string $state
 * @property string $zip
 */
class Address extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%stripe_card_address}}';
    }

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
            [['uid', 'customer_id'], 'require'],
            [['id', 'customer_id'], 'integer'],
            [['city', 'country', 'line1', 'line2', 'state', 'zip'], 'string'],
        ];
    }
}
