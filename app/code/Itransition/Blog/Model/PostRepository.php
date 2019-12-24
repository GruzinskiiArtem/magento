<?php

namespace Itransition\Blog\Model;

use Itransition\Blog\Api\PostRepositoryInterface;
use Itransition\Blog\Model\ResourceModel\Post as ResourcePost;
use Itransition\Blog\Model\ResourceModel\Post\CollectionFactory as PostCollectionFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;


class PostRepository implements PostRepositoryInterface
{
    /**
     * @var ResourcePost
     */
    protected $resource;

    /**
     * @var PostFactory
     */
    protected $postFactory;

    /**
     * @var PostCollectionFactory
     */
    protected $postCollectionFactory;

    /**
     * PostRepository constructor.
     *
     * @param ResourcePost $resource
     * @param PostFactory $postFactory
     * @param PostCollectionFactory $postCollectionFactory
     */
    public function __construct(
        ResourcePost $resource,
        PostFactory $postFactory,
        PostCollectionFactory $postCollectionFactory
    ) {
        $this->resource = $resource;
        $this->postFactory = $postFactory;
        $this->postCollectionFactory = $postCollectionFactory;
    }

    /**
     * Save Page data
     *
     * @param \Itransition\Blog\Api\Data\PostInterface|Post $post
     * @return Post
     * @throws CouldNotSaveException
     */
    public function save(\Itransition\Blog\Api\Data\PostInterface $post)
    {
        try {
            $this->resource->save($post);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the page: %1', $exception->getMessage()),
                $exception
            );
        }
        return $post;
    }

    /**
     * Load Page data by given Page Identity
     *
     * @param string $postId
     * @return Post
     * @throws NoSuchEntityException
     */
    public function getById($postId)
    {
        $post = $this->postFactory->create();
        $post->load($postId);

        if (!$post->getId()) {
            throw new NoSuchEntityException(__('The Blog page with the "%1" ID doesn\'t exist.', $postId));
        }

        return $post;
    }

    /**
     * @param string $identifier
     * @return Post
     * @throws NoSuchEntityException
     */
    public function getByIdentifier($identifier)
    {
        $post = $this->$this->postFactory->create();
        $post-> ($identifier);
        if (!$post->getId()) {
            throw new NoSuchEntityException(__('The Blog page with the "%1" ID doesn\'t exist.', $identifier));
        }

        return $post;
    }

    /**
     * Delete Page
     *
     * @param \Itransition\Blog\Api\Data\PostInterface $post
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(\Itransition\Blog\Api\Data\PostInterface $post)
    {
        try {
            $this->resource->delete($post);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(
                __('Could not delete the page: %1', $exception->getMessage())
            );
        }
        return true;
    }

    /**
     * Delete Page by given Page Identity
     *
     * @param string $postId
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($postId)
    {
        return $this->delete($this->getById($postId));
    }
}
