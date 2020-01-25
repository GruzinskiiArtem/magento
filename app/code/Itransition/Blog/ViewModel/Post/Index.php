<?php

namespace Itransition\Blog\ViewModel\Post;

use Itransition\Blog\Model\ResourceModel\Post\Collection;
use Itransition\Blog\Model\ResourceModel\Post\CollectionFactory;
use Itransition\Blog\Api\Data\PostInterface;
use Magento\Framework\UrlInterface;
use Itransition\Blog\Helper\BlogConfig;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class Index implements ArgumentInterface
{
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var UrlInterface
     */
    private $urlBuilder;

    /**
     * @var BlogConfig
     */
    private $helperBlogConfig;

    /**
     * Index constructor.
     * @param CollectionFactory $collectionFactory
     * @param BlogConfig $helperBlogConfig
     * @param UrlInterface $urlBuilder
     * @param array $data
     */
    public function  __construct(CollectionFactory $collectionFactory, BlogConfig $helperBlogConfig, UrlInterface $urlBuilder,array $data = [])
    {
        $this->helperBlogConfig = $helperBlogConfig;
        $this->urlBuilder = $urlBuilder;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @return Collection
     */
    public function getPostCollection(): Collection
    {
        /** @var Collection $postCollection */
        $postCollection = $this->collectionFactory->create()->addFieldToFilter(PostInterface::IS_ACTIVE, 1)->setPageSize($this->helperBlogConfig->getGeneralConfig());
        return $postCollection;
    }

    /**
     * @param string $identifier
     * @return string
     */
    public function generateUrl($identifier): string
    {
        return $this->urlBuilder->getUrl(null, ['blog' => $identifier]);
    }

    /**
     * @param PostInterface $post
     * @return string
     */
    public function getImageUrl($post): string
    {
        return $post->getImageUrl($post->getImageName());
    }

}
