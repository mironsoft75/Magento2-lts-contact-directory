<?php
/**
 * Created by PhpStorm.
 * User: Lozingle
 * Date: 17/04/2017
 * Time: 05:54 PM
 */
namespace Lts\Contact\Block;

class Contact extends \Magento\Framework\View\Element\Template
{

    protected $_scopeConfig;

    protected $_helper;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Lts\Contact\Helper\Data $helper,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    )
    {
        $this->_scopeConfig = $scopeConfig;
        $this->_helper = $helper;
        parent::__construct($context);
    }

    public function getConfigvalue($name)
    {
        $config_path = "contact_configuration/".$name;
        return $this->_scopeConfig->getValue($config_path, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    public function getFormAction()
    {
        return $this->_helper->getRootUrl().'contact/index/post';
    }

}
