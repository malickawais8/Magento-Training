<?php

declare(strict_types=1);

namespace RLTSquare\Unit3\Helper\Data;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{

    /**
     * @return mixed
     */
    public function isEnable(): mixed
    {
        return $this->scopeConfig->getValue('unit3/general/enable', ScopeInterface::SCOPE_STORE);
    }

    /**
     * @param $config_path
     * @return mixed
     */
    public function getConfig($config_path): mixed
    {
        return $this->scopeConfig->getValue(
            $config_path,
            ScopeInterface::SCOPE_STORE
        );
    }
}
