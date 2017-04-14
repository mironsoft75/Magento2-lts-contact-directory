<?php
/**
 * Created by PhpStorm.
 * User: Lozingle
 * Date: 11/04/2017
 * Time: 04:17 PM
 */
namespace Lts\Contact\Controller\Adminhtml\Contact;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action;

class Index extends Action
{
    const ADMIN_RESOURCE = 'Lts_Contact::contact';

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Index action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Lts_Contact::contact');
        $resultPage->addBreadcrumb(__('Contact'), __('Contact'));
        $resultPage->addBreadcrumb(__('Manage Contacts'), __('Manage Contacts'));
        $resultPage->getConfig()->getTitle()->prepend(__('Contact'));

        return $resultPage;
    }
}