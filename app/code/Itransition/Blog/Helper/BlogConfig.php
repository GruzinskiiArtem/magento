<?php

namespace Itransition\Blog\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class BlogConfig extends AbstractHelper
{

    const XML_PATH_BLOG = 'post/general/number_of_posts';

    /**
     * @param $field
     * @param string $storeId
     * @return string
     */
    private function getConfigValue($field, $storeId = null): string
    {
        return $this->scopeConfig->getValue(
            $field, ScopeInterface::SCOPE_STORE, $storeId
        );
    }

    /**
     * @param string $storeId
     * @return string
     */
    public function getGeneralConfig($storeId = null): string
    {

        return $this->getConfigValue(self::XML_PATH_BLOG, $storeId);
    }
}
