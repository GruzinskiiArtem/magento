<?php

namespace Itransition\Blog\ViewModel\Post;

use Itransition\Blog\Api\Data\PostInterface;
use Itransition\Blog\Model\Post;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;
use Magento\Framework\Registry;
use Itransition\Blog\Model\Post\ImageUploader;
use Magento\Framework\UrlInterface;
use Magento\Catalog\Model\ProductRepository;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Catalog\Api\Data\ProductInterface;

class View implements ArgumentInterface
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

    public function __construct(Registry $registry, ProductRepository $productRepository, ImageUploader $imageUploader, UrlInterface $url, array $data = [])
    {
        $this->productRepository = $productRepository;
        $this->url = $url;
        $this->imageUploader = $imageUploader;
        $this->registry = $registry;
    }

    /**
     * @return Post
     */
    private function getPost(): Post
    {
        return $this->registry->registry('current_post');
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->getPost()->getTitle();
    }

    /**
     * @return string
     */
    public function getImageName(): string
    {
        return $this->getPost()->getImageName();
    }

    /**
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getImageUrl(): string
    {
        return $this->getPost()->getImageUrl($this->getImageName());
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->getPost()->getContent();
    }

    /**
     * @return string
     */
    public function getCreationTime(): string
    {
        return $this->getPost()->getCreationTime();
    }

    /**
     * @return bool
     */
    public function isProductId(): bool
    {
        $productId = $this->getPost()->getProductId();
        return isset($productId) ? true : false;
    }

    /**
     * @return string
     * @throws NoSuchEntityException
     */
    public function getProductUrl(): string
    {
        $product = $this->getProduct($this->getPost()->getProductId());
        if (isset($product)) {
            return $product->getProductUrl();
        } else {
            return '';
        }
    }

    /**
     * @param $productEntityId
     * @return ProductInterface|null
     * @throws NoSuchEntityException
     */
    private function getProduct($productEntityId): ?ProductInterface
    {
        if (!isset($productEntityId)) {
            return null;
        }
        return $this->productRepository->getById($productEntityId);
    }
}
