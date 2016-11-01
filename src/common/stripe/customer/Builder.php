<?php
/**
 * Copyright © 2016 GBKSOFT. Web and Mobile Software Development.
 * See LICENSE.txt for license details.
 */
namespace dell\stripe\common\stripe\customer;

use dell\stripe\models\stripe\Customer;

/**
 * Class Builder
 */
class Builder
{
    /**
     * @var int
     */
    private $userId;

    /**
     * @var \Stripe\Customer
     */
    private $customer;

    /**
     * @var string
     */
    private $mode;

    /**
     * @var string
     */
    private $email;

    /**
     * @param int $id
     * @return $this
     */
    public function setUserId($id)
    {
        $this->userId = $id;

        return $this;
    }

    /**
     * @param \Stripe\Customer $customer
     * @return $this
     */
    public function setCustomer(\Stripe\Customer $customer)
    {
        $this->customer = $customer;

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
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Customer
     */
    public function build()
    {
        try {
            $customer = $this->getModel();

            $attributes = $this->mapAttributes();

            $customer->setAttributes($attributes);

            return $customer;
        } finally {
            $this->userId = null;
            $this->mode = null;
            $this->email = null;
            $this->customer = null;
        }
    }

    /**
     * @return array
     */
    private function mapAttributes()
    {
        return [
            'user_id' => $this->userId,
            'uid' => $this->customer->id,
            'mode' => $this->mode,
            'email' => $this->email,
            'description' => $this->customer->description,
            'currency' => $this->customer->currency,
        ];
    }

    /**
     * @return Customer
     */
    private function getModel()
    {
        $customer = Customer::findByUid($this->customer->id);

        if ($customer === null) {
            $customer = new Customer();
        }

        return $customer;
    }
}
