<?php

namespace Itransition\BlogAdminPage\Api\Data;

/**
 * Blog page interface
 */
interface PageInterface
{
    const PAGE_ID       = 'page_id';
    const TITLE         = 'title';
    const CONTENT       = 'content';
    const ENABLED       = 'enabled';
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
     * Get enabled
     *
     * @return bool
     */
    public function getEnabled();

    /**
     * Get identifier
     *
     * @return string
     */
    public function getIdentifier();
}
