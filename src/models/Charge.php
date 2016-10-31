<?php
/**
 * Copyright © 2016 GBKSOFT. Web and Mobile Software Development.
 * See LICENSE.txt for license details.
 */
namespace gbksoft\stripe\models;

use yii\base\Model;

/**
 * Class Charge
 */
class Charge extends Model
{
    /**
     * @var string
     */
    public $token;

    /**
     * @var int
     */
    public $amount;

    /**
     * @var string
     */
    public $currency;

    /**
     * @var SourceInterface
     */
    public $source;

    /**
     * @var string
     */
    public $description;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['token', 'amount', 'currency', 'source'], 'required'],
            [['description', 'token', 'currency'], 'string'],
            ['amount', 'integer'],
            ['source', function ($attribute) {
                if (!($this->source instanceof SourceInterface && $this->source instanceof Source)) {
                    $this->addError($attribute, 'Source should implement "Source Interface".');
                }
            }]
        ];
    }

    /**
     * @return bool
     */
    public function execute()
    {
        if (!$this->validate()) {
            return false;
        }

        return true;
    }
}
