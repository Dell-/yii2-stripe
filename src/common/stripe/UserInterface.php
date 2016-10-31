<?php
/**
 * Copyright © 2016 GBKSOFT. Web and Mobile Software Development.
 * See LICENSE.txt for license details.
 */
namespace dell\stripe\common\stripe;

use dell\stripe\common\stripe\user\OrderInterface;

/**
 * Interface UserInterface
 */
interface UserInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @return OrderInterface
     */
    public function getOrder();
}
