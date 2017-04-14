<?php
/**
 * Created by PhpStorm.
 * User: Lozingle
 * Date: 11/04/2017
 * Time: 05:08 PM
 */
namespace Lts\Contact\Controller\Adminhtml\Contact;

use Lts\Contact\Controller\Adminhtml\Contact;

class Edit extends Contact
{
    /**
     * Init actions
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function _initAction()
    {
        // load layout, set active menu and breadcrumbs
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Lts_Contact::contact')
            ->addBreadcrumb(__('Contact'), __('Contact'))
            ->addBreadcrumb(__('Manage Contacts'), __('Manage Contacts'));
        return $resultPage;
    }

    /**
     * Edit Department
     *
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        //echo $id; die("EDIT");
        $contactModel = $this->_contactFactory->create();

        // If you have got an id, it's edition
        if ($id) {
            $contactModel->load($id);
            if (!$contactModel->getId()) {
                $this->messageManager->addError(__('This Contact not exists.'));
                /** \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();

                return $resultRedirect->setPath('*/*/');
            }
        }

        $data = $this->_getSession()->getContactData(true);
        if (!empty($data)) {
            $contactModel->setData($data);
        }

        /* Register model to use later in blocks */
        $this->_coreRegistry->register('contact_contact', $contactModel);

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb(
            $id ? __('Edit Contact') : __('New Contact'),
            $id ? __('Edit Contact') : __('New Contact')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Contact'));
        $resultPage->getConfig()->getTitle()
            ->prepend($contactModel->getId() ? $contactModel->getName() : __('New Contact'));
        return $resultPage;
    }
}