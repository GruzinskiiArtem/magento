<?php

namespace Itransition\Blog\ViewModel\Post;

use Itransition\Blog\Api\Data\PostInterface;
use Itransition\Blog\Model\Post;
use Itransition\Blog\Model\ResourceModel\Post\Collection;
use Itransition\Blog\Model\ResourceModel\Post\CollectionFactory;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Block\Product\View;
use Magento\Catalog\Block\Product\Context;
use Magento\Framework\UrlInterface;

class Product extends View
{
    /**
     * @var CollectionFactory
     */
    private $postCollection;

    /**
     * @var UrlInterface
     */
    private $urlBuilder;

    public function __construct(Context $context, CollectionFactory $postCollection, UrlInterface $urlBuilder, \Magento\Framework\Url\EncoderInterface $urlEncoder, \Magento\Framework\Json\EncoderInterface $jsonEncoder, \Magento\Framework\Stdlib\StringUtils $string, \Magento\Catalog\Helper\Product $productHelper, \Magento\Catalog\Model\ProductTypes\ConfigInterface $productTypeConfig, \Magento\Framework\Locale\FormatInterface $localeFormat, \Magento\Customer\Model\Session $customerSession, ProductRepositoryInterface $productRepository, \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency, array $data = [])
    {
        $this->postCollection = $postCollection;
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $urlEncoder, $jsonEncoder, $string, $productHelper, $productTypeConfig, $localeFormat, $customerSession, $productRepository, $priceCurrency, $data);
    }

    /**
     * @return Collection
     */
    public function getPosts(): Collection
    {
        return $this->postCollection->create()->addFieldToFilter(PostInterface::PRODUCT_ID, $this->getProduct()->getId());
    }

    /**
     * @param string $identifier
     * @return string
     */
    public function generateUrl($identifier): string
    {
        return $this->urlBuilder->getUrl(null, ['blog' => $identifier]);
    }
}
