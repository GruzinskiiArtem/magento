<?php

namespace Itransition\Blog\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class BlogConfig extends AbstractHelper
{

    const XML_PATH_BLOG = 'post/general/number_of_posts';

    private function getConfigValue($field, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            $field, ScopeInterface::SCOPE_STORE, $storeId
        );
    }

    public function getGeneralConfig($storeId = null)
    {

        return $this->getConfigValue(self::XML_PATH_BLOG, $storeId);
    }
}
