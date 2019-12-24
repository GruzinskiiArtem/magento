<?php

namespace Itransition\Blog\Block\Post;

use Itransition\Blog\Model\ResourceModel\Post\Collection;
use Itransition\Blog\Model\ResourceModel\Post\CollectionFactory;
use Magento\Framework\View\Element\Template;
use Itransition\Blog\Api\Data\PostInterface;
use Magento\Framework\UrlInterface;

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
     * Index constructor.
     * @param Template\Context $context
     * @param CollectionFactory $collectionFactory
     * @param UrlInterface $urlBuilder
     * @param array $data
     */
    public function  __construct(Template\Context $context, CollectionFactory $collectionFactory, UrlInterface $urlBuilder,array $data = [])
    {
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
        $postCollection = $this->collectionFactory->create()->addFieldToFilter(PostInterface::IS_ACTIVE, 1);
        return $postCollection;
    }

    public function generateUrl($identifier)
    {
        return $this->urlBuilder->getUrl(null, ['blog' => $identifier]);
    }

}
