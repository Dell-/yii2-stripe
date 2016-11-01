<?php
/**
 * Copyright © 2016 GBKSOFT. Web and Mobile Software Development.
 * See LICENSE.txt for license details.
 */
namespace dell\stripe\common\fake;

use dell\stripe\common\fake\order\Item;
use dell\stripe\common\stripe\user\order\ItemInterface;
use dell\stripe\common\stripe\user\OrderInterface;
use dell\stripe\common\stripe\UserInterface;
use yii\base\Model;

/**
 * Class Order
 */
class Order extends Model implements OrderInterface
{
    /**
     * @var UserInterface
     */
    private $user;

    /**
     * @var ItemInterface[]
     */
    private $items;

    /**
     * @param UserInterface $user
     */
    public function setUser(UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     * @return UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return ItemInterface[]
     */
    public function getItems()
    {
        if (!empty($this->items)) {
            return $this->items;
        }

        $this->items = [];
        for ($i = 0; $i < 2; ++$i) {
            $item = new Item();
            $item->setOrder($this);
            $this->items[] = $item;
        }

        return $this->items;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return 1;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return 'usd';
    }

    /**
     * @return float
     */
    public function getTotalPrice()
    {
        $price = 0;

        foreach ($this->getItems() as $item) {
            $price += $item->getPrice();
        }

        return $price;
    }
}
