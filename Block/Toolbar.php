<?php

namespace ADM\QuickDevBar\Block;

use ADM\QuickDevBar\Helper\AccessChecker;
use ADM\QuickDevBar\Helper\Data;
use ADM\QuickDevBar\Block\Tab;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Template\Context;

class Toolbar extends \Magento\Framework\View\Element\Template
{
    protected $_mainTabs;

    protected $_qdnHelper;

    private  $frontUrl;


    /**
     * @var AccessChecker
     */
    protected $accessChecker;


    /**
     * @param Context $context
     * @param Data $qdnHelper
     * @param UrlInterface $frontUrl
     * @param AccessChecker $accessChecker
     * @param array $data
     */
    public function __construct(
        Context       $context,
        Data          $qdnHelper,
        UrlInterface  $frontUrl,
        AccessChecker $accessChecker,
        array         $data = []
    ) {
        parent::__construct($context, $data);

        $this->_qdnHelper = $qdnHelper;
        $this->frontUrl = $frontUrl;
        $this->accessChecker = $accessChecker;
    }

    /**
     * Determine if action is allowed
     *
     * @return bool
     */
    protected function canDisplay()
    {
        return $this->accessChecker->isToolbarAccessAllowed() && $this->_qdnHelper->isToolbarAreaAllowed($this->getArea());
    }

    public function getAppearance()
    {
        return $this->_qdnHelper->defaultAppearance();
    }

    public function getBaseUrl()
    {
        return $this->frontUrl->getUrl();
    }

    public function isAjaxLoading()
    {
        return $this->_qdnHelper->isAjaxLoading() ? "true" : "false";
    }

    public function toHtml()
    {
        return (!$this->canDisplay()) ? '' : parent::toHtml();
    }
}
