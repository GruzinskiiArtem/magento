<?php

namespace Itransition\Blog\Model\ResourceModel\Post;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    public function __construct()
    {
        $this->_init(\Itransition\Blog\Model\Post::class, \Itransition\Blog\Model\ResourceModel\Post::class);
    }
}
