<?php

namespace Itransition\Blog\Block\Post;

use Itransition\Blog\Api\Data\PostInterface;
use Itransition\Blog\Model\ResourceModel\Post\CollectionFactory;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Block\Product\View;
use Magento\Catalog\Block\Product\Context;

class Product extends View
{
    /**
     * @var CollectionFactory
     */
    private $postCollection;

    public function __construct(Context $context, CollectionFactory $postCollection, \Magento\Framework\Url\EncoderInterface $urlEncoder, \Magento\Framework\Json\EncoderInterface $jsonEncoder, \Magento\Framework\Stdlib\StringUtils $string, \Magento\Catalog\Helper\Product $productHelper, \Magento\Catalog\Model\ProductTypes\ConfigInterface $productTypeConfig, \Magento\Framework\Locale\FormatInterface $localeFormat, \Magento\Customer\Model\Session $customerSession, ProductRepositoryInterface $productRepository, \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency, array $data = [])
    {
        $this->postCollection = $postCollection;
        parent::__construct($context, $urlEncoder, $jsonEncoder, $string, $productHelper, $productTypeConfig, $localeFormat, $customerSession, $productRepository, $priceCurrency, $data);
    }

    public function getPosts()
    {
        $collection = $this->postCollection->create()->addFieldToFilter(PostInterface::PRODUCT_ID, $this->getProduct()->getId());
        return $collection;
    }
}
