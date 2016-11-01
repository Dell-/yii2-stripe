<?php
/**
 * Copyright © 2016 GBKSOFT. Web and Mobile Software Development.
 * See LICENSE.txt for license details.
 */
namespace dell\stripe\common\stripe\user;

use dell\stripe\common\fake\User;
use dell\stripe\common\stripe\UserInterface;

/**
 * Class Service
 */
class Service
{
    /**
     * @return UserInterface
     */
    public function getCurrentUser()
    {
        return new User();
    }
}
