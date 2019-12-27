<?php

namespace Itransition\Blog\Api\Data;

/**
 * Blog post interface
 */
interface PostInterface
{
    const POST_ID       = 'post_id';
    const TITLE         = 'title';
    const CONTENT       = 'content';
    const IS_ACTIVE     = 'is_active';
    const IDENTIFIER    = 'identifier';
    const CREATION_TIME = 'creation_time';
    const UPDATE_TIME   = 'update_time';
    const IMAGE_NAME    = 'image';
    const PRODUCT_ID    = 'product_id';

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
     * @return string
     */
    public function getImageName();

    /**
     * @return int|null
     */
    public function getProductId();

    /**
     * @param int $id
     * @return PostInterface
     */
    public function setId($id);

    /**
     * @param string $title
     * @return PostInterface
     */
    public function setTitle($title);

    /**
     * @param string $content
     * @return PostInterface
     */
    public function setContent($content);

    /**
     * @param bool $isActive
     * @return PostInterface
     */
    public function setIsActive($isActive);

    /**
     * @param $identifier
     * @return PostInterface
     */
    public function setIdentifier($identifier);

    /**
     * @param string $creationTime
     * @return PostInterface
     */
    public function setCreationTime($creationTime);

    /**
     * @param string $updateTime
     * @return PostInterface
     */
    public function setUpdateTime($updateTime);
}
