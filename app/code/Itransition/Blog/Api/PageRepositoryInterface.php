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
     * Delete page.
     *
     * @param PageInterface $page
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(PageInterface  $page);
}