<?php
/**
 * Copyright © 2016 GBKSOFT. Web and Mobile Software Development.
 * See LICENSE.txt for license details.
 */
namespace dell\stripe\common\stripe\user\order;

use dell\stripe\common\stripe\user\OrderInterface;

/**
 * Interface ItemInterface
 */
interface ItemInterface
{
    /**
     * @return OrderInterface
     */
    public function getOrder();

    /**
     * @return float
     */
    public function getPrice();
}
