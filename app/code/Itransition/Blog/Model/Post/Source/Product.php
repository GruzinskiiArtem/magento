<?php

namespace Itransition\Blog\Model\Post\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

class Product implements OptionSourceInterface
{
    /**
     * @var CollectionFactory
     */
    private $productCollectionFactory;

    public function __construct(CollectionFactory $productCollectionFactory)
    {
        $this->productCollectionFactory = $productCollectionFactory;
    }

    /**
     * @return array
     */
    public function toOptionArray(): array
    {
        /**
         * @var \Magento\Catalog\Model\Product $product;
         */
        $products = $this->productCollectionFactory->create()
            ->addAttributeToSelect('*');
        $productNameList = [];
        foreach ($products as $product) {
            $productNameList[] = ['value' => $product->getEntityId(), 'label' => $product->getName()];
        }
        return $productNameList;
    }

}
