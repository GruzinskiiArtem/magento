<?php

namespace Itransition\Blog\Api;

use Itransition\Blog\Api\Data\PostInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

interface PostRepositoryInterface
{

    /**
     * Save post.
     *
     * @param PostInterface $page
     * @return PostInterface
     * @throws LocalizedException
     */
    public function save(PostInterface $page);

    /**
     * Retrieve post.
     *
     * @param int $pageId
     * @return PostInterface
     * @throws LocalizedException
     */
    public function getById($pageId);

    /**
     * Delete post.
     *
     * @param PostInterface $page
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(PostInterface  $page);

    /**
     * Delete post by ID.
     *
     * @param int $pageId
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById($pageId);
}
