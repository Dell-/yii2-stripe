<?php
/**
 * Copyright © 2016 GBKSOFT. Web and Mobile Software Development.
 * See LICENSE.txt for license details.
 */
namespace dell\stripe\common\stripe\card\address;

use dell\stripe\models\stripe\source\card\Address;

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
     * @var int
     */
    private $cardId;

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
     * @param int $id
     * @return $this
     */
    public function setCardId($id)
    {
        $this->cardId = $id;

        return $this;
    }

    /**
     * @return Address
     */
    public function build()
    {
        try {
            $address = $this->getModel();

            $attributes = $this->mapAttributes();

            $address->setAttributes($attributes);

            return $address;
        } finally {
            $this->card = null;
            $this->mode = null;
            $this->customerId = null;
            $this->cardId = null;
        }
    }

    /**
     * @return array
     */
    private function mapAttributes()
    {
        return [
            'uid' => $this->card->id,
            'customer_id' => $this->customerId,
            'card_id' => $this->cardId,
            'city' => $this->card->city,
            'country' => $this->card->country,
            'line1' => $this->card->address_line1,
            'line2' => $this->card->address_line2,
            'state' => $this->card->address_state,
            'zip' => $this->card->address_zip,
        ];
    }

    /**
     * @return Address
     */
    private function getModel()
    {
        $card = Address::findByUid($this->card->id);

        if ($card === null) {
            $card = new Address();
        }

        return $card;
    }
}
