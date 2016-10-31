<?php
/**
 * Copyright © 2016 GBKSOFT. Web and Mobile Software Development.
 * See LICENSE.txt for license details.
 */
namespace dell\stripe\common\fake;

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
     * @return UserInterface
     */
    public function getUser()
    {
        // TODO: Implement getUser() method.
    }

    /**
     * @return ItemInterface[]
     */
    public function getItems()
    {
        // TODO: Implement getItems() method.
    }

    /**
     * @return int
     */
    public function getId()
    {

    }
}
