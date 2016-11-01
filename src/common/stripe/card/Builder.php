<?php
/**
 * Copyright © 2016 GBKSOFT. Web and Mobile Software Development.
 * See LICENSE.txt for license details.
 */
namespace dell\stripe\common\stripe\card;

use dell\stripe\models\stripe\source\Card;

/**
 * Class Builder
 */
class Builder
{
    /**
     * @var \Stripe\Card
     */
    private $card;

    /**
     * @var string
     */
    private $mode;

    /**
     * @var int
     */
    private $customerId;

    /**
     * @var bool
     */
    private $isDefault;

    /**
     * @param \Stripe\Card $card
     * @return $this
     */
    public function setCard(\Stripe\Card $card)
    {
        $this->card = $card;

        return $this;
    }

    /**
     * @param string $mode
     * @return $this
     */
    public function setMode($mode)
    {
        $this->mode = $mode;

        return $this;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setCustomerId($id)
    {
        $this->customerId = $id;

        return $this;
    }

    /**
     * @param bool $flag
     * @return $this
     */
    public function setIsDefault($flag)
    {
        $this->isDefault = $flag;

        return $this;
    }

    /**
     * @return Card
     */
    public function build()
    {
        try {
            $card = $this->getModel();

            $attributes = $this->mapAttributes();

            $card->setAttributes($attributes);

            return $card;
        } finally {
            $this->card = null;
            $this->mode = null;
            $this->customerId = null;
            $this->isDefault = null;
        }
    }

    /**
     * @return array
     */
    private function mapAttributes()
    {
        return [
            'customer_id' => $this->customerId,
            'uid' => $this->card->id,
            'mode' => $this->mode,
            'brand' => $this->card->brand,
            'funding' => $this->card->funding,
            'country' => $this->card->country,
            'exp_month' => $this->card->exp_month,
            'exp_year' => $this->card->exp_year,
            'last4' => $this->card->last4,
            'data' => json_encode($this->card),
            'is_default' => $this->isDefault,
        ];
    }

    /**
     * @return Card
     */
    private function getModel()
    {
        $card = Card::findByUid($this->card->id);

        if ($card === null) {
            $card = new Card();
        }

        return $card;
    }
}
