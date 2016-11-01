<?php
/**
 * Copyright © 2016 GBKSOFT. Web and Mobile Software Development.
 * See LICENSE.txt for license details.
 */
namespace dell\stripe\common\stripe\transaction;

use dell\stripe\models\stripe\Transaction;

/**
 * Class Builder
 */
class Builder
{
    /**
     * @var \Stripe\Charge
     */
    private $transaction;

    /**
     * @var int
     */
    private $customerId;

    /**
     * @var string
     */
    private $mode;

    /**
     * @var string
     */
    private $type;

    /**
     * @param \Stripe\Charge $transaction
     * @return $this
     */
    public function setTransaction(\Stripe\Charge $transaction)
    {
        $this->transaction = $transaction;

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
     * @param string $mode
     * @return $this
     */
    public function setMode($mode)
    {
        $this->mode = $mode;

        return $this;
    }

    /**
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Transaction
     */
    public function build()
    {
        try {
            $transaction = new Transaction();

            $attributes = $this->mapAttributes();

            $transaction->setAttributes($attributes);

            return $transaction;
        } finally {
            $this->transaction = null;
            $this->customerId = null;
            $this->mode = null;
            $this->type = null;
        }
    }

    /**
     * @return array
     */
    private function mapAttributes()
    {
        $statuses = [
            'succeeded' => Transaction::STATUS_SUCCEEDED,
            'pending' => Transaction::STATUS_PENDING,
            'failed' => Transaction::STATUS_FAILED,
        ];

        return [
            'uid' => $this->transaction->id,
            'order_id' => $this->transaction->metadata['order_id'],
            'customer_id' => $this->customerId,
            'mode' => $this->mode,
            'type' => $this->type,
            'status' => $statuses[$this->transaction->status],
            'amount' => $this->transaction->amount,
            'description' => $this->transaction->description,
            'data' => json_encode($this->transaction),
        ];
    }
}
