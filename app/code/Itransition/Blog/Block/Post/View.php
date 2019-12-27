<?php

namespace Itransition\Blog\Block\Post;

use Itransition\Blog\Model\Post;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;
use Magento\Framework\Registry;
use Itransition\Blog\Model\Post\ImageUploader;
use Magento\Framework\UrlInterface;
use Magento\Catalog\Model\ProductRepository;

class View extends Template
{
    /**
     * @var Registry
     */
    private $registry;

    /**
     * @var ImageUploader
     */
    private $imageUploader;
    /**
     * @var UrlInterface
     */
    private $url;

    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(Template\Context $context, Registry $registry, ProductRepository $productRepository, ImageUploader $imageUploader, UrlInterface $url, array $data = [])
    {
        $this->productRepository = $productRepository;
        $this->url = $url;
        $this->imageUploader = $imageUploader;
        $this->registry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * @return Post
     */
    private function getPost()
    {
        return $this->registry->registry('current_post');
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->getPost()->getTitle();
    }

    /**
     * @return string
     */
    public function getImageName()
    {
        return $this->getPost()->getImageName();
    }

    /**
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getImageUrl()
    {
        return $this->getPost()->getImageUrl($this->getImageName());
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->getPost()->getContent();
    }

    /**
     * @return string
     */
    public function getCreationTime()
    {
        return $this->getPost()->getCreationTime();
    }

    public function getProductId()
    {
        $productId = $this->getPost()->getProductId();
        return isset($productId) ? true : false;
    }

    public function getProductUrl()
    {
        $product = $this->getProduct($this->getPost()->getProductId());
        if (isset($product)) {
            return $product->getProductUrl();
        } else {
            return '';
        }
    }

    private function getProduct($productEntityId)
    {
        if (!isset($productEntityId)) {
            return null;
        }
        return $this->productRepository->getById($productEntityId);
    }
}
