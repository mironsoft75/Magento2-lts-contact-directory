<?php
/**
 * Created by PhpStorm.
 * User: Lozingle
 * Date: 11/04/2017
 * Time: 06:54 PM
 */
namespace Lts\Contact\Controller\Adminhtml\Contact;

use Lts\Contact\Controller\Adminhtml\Contact;

class Delete extends Contact
{


    public function execute()
    {
        $id = (int) $this->getRequest()->getParam('id');

        /** @var $newsModel \Lts\Contact\Model\Contact */
        $contactModel = $this->_contactFactory->create();

        if ($id) {

            $contactModel->load($id);

            // Check this news exists or not
            if (!$contactModel->getId()) {
                $this->messageManager->addError(__('This Contact no longer exists.'));
            } else {
                try {
                    // Delete news
                    $contactModel->delete();
                    $this->messageManager->addSuccess(__('The Contact has been deleted.'));

                    // Redirect to grid page
                    $this->_redirect('*/*/');
                    return;
                } catch (\Exception $e) {
                    $this->messageManager->addError($e->getMessage());
                    $this->_redirect('*/*/edit', ['id' => $contactModel->getId()]);
                }
            }
        }
    }
}