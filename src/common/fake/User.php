<?php
/**
 * Copyright © 2016 GBKSOFT. Web and Mobile Software Development.
 * See LICENSE.txt for license details.
 */
namespace dell\stripe\common\fake;

use dell\stripe\common\stripe\user\OrderInterface;
use dell\stripe\common\stripe\UserInterface;
use yii\base\Model;

/**
 * Class User
 */
class User extends Model implements UserInterface
{
    /**
     * @var OrderInterface
     */
    private $order;

    /**
     * @return int
     */
    public function getId()
    {
        return 1;
    }

    /**
     * @return OrderInterface
     */
    public function getOrder()
    {
        if (!$this->order) {
            $this->order = new Order();
            $this->order->setUser($this);
        }

        return $this->order;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return 'william.thomas@example.com';
    }
}
