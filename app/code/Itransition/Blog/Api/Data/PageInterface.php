<?php

namespace Itransition\Blog\Api\Data;

use Magento\Tests\NamingConvention\true\string;

/**
 * Blog page interface
 */
interface PageInterface
{
    const PAGE_ID       = 'page_id';
    const TITLE         = 'title';
    const CONTENT       = 'content';
    const IS_ACTIVE     = 'is_active';
    const IDENTIFIER    = 'identifier';
    const CREATION_TIME = 'creation_time';
    const UPDATE_TIME   = 'update_time';

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get title
     *
     * @return string|null
     */
    public function getTitle();

    /**
     * Get content
     *
     * @return string|null
     */
    public function getContent();

    /**
     * Get is active
     *
     * @return bool
     */
    public function getIsActive();

    /**
     * Get identifier
     *
     * @return string
     */
    public function getIdentifier();

    /**
     * Get creation time
     *
     * @return string|null
     */
    public function getCreationTime();

    /**
     * Get update time
     *
     * @return string|null
     */
    public function getUpdateTime();

    /**
     * @param int $id
     * @return \Itransition\Blog\Api\Data\PageInterface
     */
    public function setId($id);

    /**
     * @param string $title
     * @return \Itransition\Blog\Api\Data\PageInterface
     */
    public function setTitle($title);

    /**
     * @param string $content
     * @return \Itransition\Blog\Api\Data\PageInterface
     */
    public function setContent($content);

    /**
     * @param bool $isActive
     * @return \Itransition\Blog\Api\Data\PageInterface
     */
    public function setIsActive($isActive);

    /**
     * @param $identifier
     * @return \Itransition\Blog\Api\Data\PageInterface
     */
    public function setIdentifier($identifier);

    /**
     * @param string $creationTime
     * @return \Itransition\Blog\Api\Data\PageInterface
     */
    public function setCreationTime($creationTime);

    /**
     * @param string $updateTime
     * @return \Itransition\Blog\Api\Data\PageInterface
     */
    public function setUpdateTime($updateTime);
}
