<?php

namespace Itransition\Blog\Model\ResourceModel;

use Itransition\Blog\Api\Data\PostInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Post extends AbstractDb
{
    const TABLE_NAME = 'itransition_blog_post';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(self::TABLE_NAME, PostInterface::POST_ID);
    }

    /**
     * @param $identifier
     *
     * @return string
     */
    public function loadByIdentifier($identifier)
    {
        $connection = $this->getConnection();

        $select = $connection->select()->from([
            'e' => $connection->getTableName(self::TABLE_NAME)
        ])->where('e.identifier = :identifier');
        $bind = ['identifier' => (string)$identifier];

        return $connection->fetchOne($select, $bind);
    }
}
