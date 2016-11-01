<?php
/**
 * Copyright © 2016 GBKSOFT. Web and Mobile Software Development.
 * See LICENSE.txt for license details.
 */
namespace dell\stripe\models\stripe;

use dell\stripe\models\stripe\source\Card;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Class Customer
 *
 * @property int $id
 * @property string $uid
 * @property int $user_id
 * @property string $mode
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
     * @var Card
     */
    private $selectedSource;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%stripe_customer}}';
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
            [['uid', 'user_id', 'email'], 'required'],
            [['id', 'user_id'], 'integer'],
            [['uid', 'currency', 'description'], 'string'],
            ['email', 'email'],
            ['mode', 'in', 'range' => [static::MODE_LIVE, static::MODE_TEST], 'strict' => true],
        ];
    }

    /**
     * @param string $uid
     * @return static
     */
    public static function findByUid($uid)
    {
        return static::find()
            ->where(['uid' => $uid])
            ->limit(1)
            ->one();
    }

    /**
     * @return Card
     */
    public function getSelectedSource()
    {
        return $this->selectedSource;
    }

    /**
     * @param Card $currentSource
     */
    public function setSelectedSource(Card $currentSource)
    {
        $this->selectedSource = $currentSource;
    }
}
