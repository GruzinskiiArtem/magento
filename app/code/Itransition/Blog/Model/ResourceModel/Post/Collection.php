<?php

namespace Itransition\Blog\Model\ResourceModel\Post;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'post_id';
    protected $_eventPrefix = 'itransition_blog_post_collection';
    protected $_eventObject = 'post_collection';

    public function _construct()
    {
        $this->_init(\Itransition\Blog\Model\Post::class, \Itransition\Blog\Model\ResourceModel\Post::class);
    }
}
