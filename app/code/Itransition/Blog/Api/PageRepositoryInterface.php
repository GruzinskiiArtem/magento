<?php

namespace Itransition\Blog\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Itransition\Blog\Api\Data\PageInterface;
use Magento\Framework\Exception\LocalizedException;

interface PageRepositoryInterface
{

    /**
     * Save page.
     *
     * @param PageInterface $page
     * @return PageInterface
     * @throws LocalizedException
     */
    public function save(PageInterface $page);

    /**
     * Retrieve page.
     *
     * @param int $pageId
     * @return PageInterface
     * @throws LocalizedException
     */
    public function getById($pageId);

    /**
     * Delete page.
     *
     * @param PageInterface $page
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(PageInterface  $page);
}