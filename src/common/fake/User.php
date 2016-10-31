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
     * @return int
     */
    public function getId()
    {
        // TODO: Implement getId() method.
    }

    /**
     * @return OrderInterface
     */
    public function getOrder()
    {
        // TODO: Implement getOrder() method.
    }
}
