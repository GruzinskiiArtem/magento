<?php

namespace Itransition\Blog\Block\Post;

use Itransition\Blog\Model\ResourceModel\Post\Collection;
use Itransition\Blog\Model\ResourceModel\Post\CollectionFactory;
use Magento\Framework\View\Element\Template;
use Itransition\Blog\Api\Data\PostInterface;
use Magento\Framework\UrlInterface;
use Itransition\Blog\Helper\BlogConfig;

class Index extends Template
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
     * @param Template\Context $context
     * @param CollectionFactory $collectionFactory
     * @param BlogConfig $helperBlogConfig
     * @param UrlInterface $urlBuilder
     * @param array $data
     */
    public function  __construct(Template\Context $context, CollectionFactory $collectionFactory, BlogConfig $helperBlogConfig, UrlInterface $urlBuilder,array $data = [])
    {
        $this->helperBlogConfig = $helperBlogConfig;
        $this->urlBuilder = $urlBuilder;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return Collection
     */
    public function getPostCollection()
    {
        /** @var Collection $postCollection */
        $postCollection = $this->collectionFactory->create()->addFieldToFilter(PostInterface::IS_ACTIVE, 1)->setPageSize($this->helperBlogConfig->getGeneralConfig());
//        $postCollection->getSelect()->limit(3)->order();
        return $postCollection;
    }

    public function generateUrl($identifier)
    {
        return $this->urlBuilder->getUrl(null, ['blog' => $identifier]);
    }

    public function getImageUrl($post)
    {
        $a = $post->getImageName();
        return $post->getImageUrl($post->getImageName());
    }

}
