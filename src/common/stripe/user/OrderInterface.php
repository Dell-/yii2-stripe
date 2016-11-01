<?php
/**
 * Copyright © 2016 GBKSOFT. Web and Mobile Software Development.
 * See LICENSE.txt for license details.
 */
namespace dell\stripe\common\stripe\user;

use dell\stripe\common\stripe\user\order\ItemInterface;
use dell\stripe\common\stripe\UserInterface;

/**
 * Interface OrderInterface
 */
interface OrderInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @return UserInterface
     */
    public function getUser();

    /**
     * @return ItemInterface[]
     */
    public function getItems();

    /**
     * @return string
     */
    public function getCurrency();

    /**
     * @return float
     */
    public function getTotalPrice();
}
