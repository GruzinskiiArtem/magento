<?php

namespace Itransition\Blog\Model;

use Itransition\Blog\Api\Data\PageInterface;
use Magento\Framework\Model\AbstractModel;

class Page extends AbstractModel implements PageInterface
{
    protected function _construct()
    {
        $this->_init(\Itransition\Blog\Model\ResourceModel\Page::class);
    }

    /**
     * Get ID
     *
     * @return int
     */
    public function getId()
    {
        return parent::getData(self::PAGE_ID);
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->getTitle(self::TITLE);
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->getContent(self::CONTENT);
    }

    /**
     * Get identifier
     *
     * @return string
     */
    public function getIdentifier()
    {
        return $this->getIdentifier(self::IDENTIFIER);
    }

    /**
     * Get creation time
     *
     * @return string
     */
    public function getCreationTime()
    {
        return $this->getData(self::CREATION_TIME);
    }

    /**
     * Get update time
     *
     * @return string
     */
    public function getUpdateTime()
    {
        return $this->getData(self::UPDATE_TIME);
    }

    /**
     * Get is active
     *
     * @return bool
     */
    public function getIsActive()
    {
        return (bool)$this->getData(self::IS_ACTIVE);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return \Itransition\Blog\Api\Data\PageInterface
     */
    public function setId($id)
    {
        return $this->setData(self::PAGE_ID, $id);
    }

    /**
     * Set title
     *
     * @param string $title
     * @return \Itransition\Blog\Api\Data\PageInterface
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Set content
     *
     * @param string $content
     * @return \Itransition\Blog\Api\Data\PageInterface
     */
    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * Set identifier
     *
     * @param string $identifier
     * @return \Itransition\Blog\Api\Data\PageInterface
     */
    public function setIdentifier($identifier)
    {
        return $this->setData(self::IDENTIFIER, $identifier);
    }

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return \Itransition\Blog\Api\Data\PageInterface
     */
    public function setCreationTime($creationTime)
    {
        return $this->setData(self::CREATION_TIME, $creationTime);
    }

    /**
     * Set update time
     *
     * @param string $updateTime
     * @return \Itransition\Blog\Api\Data\PageInterface
     */
    public function setUpdateTime($updateTime)
    {
        return $this->setData(self::UPDATE_TIME, $updateTime);
    }

    /**
     * Set is active
     *
     * @param int|bool $isActive
     * @return \Itransition\Blog\Api\Data\PageInterface
     */
    public function setIsActive($isActive)
    {
        return $this->setData(self::IS_ACTIVE, $isActive);
    }
}