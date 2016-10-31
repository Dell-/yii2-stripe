<?php
/**
 * Copyright © 2016 GBKSOFT. Web and Mobile Software Development.
 * See LICENSE.txt for license details.
 */
namespace dell\stripe\common\fake\order;

use dell\stripe\common\stripe\user\order\ItemInterface;
use dell\stripe\common\stripe\user\OrderInterface;
use yii\base\Model;

/**
 * Class Item
 */
class Item extends Model implements ItemInterface
{
    /**
     * @return OrderInterface
     */
    public function getOrder()
    {
        // TODO: Implement getOrder() method.
    }
}
