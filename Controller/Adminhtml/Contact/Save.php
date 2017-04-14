<?php
/**
 * Created by PhpStorm.
 * User: Lozingle
 * Date: 12/04/2017
 * Time: 12:31 PM
 */
namespace Lts\Contact\Controller\Adminhtml\Contact;

use Lts\Contact\Controller\Adminhtml\Contact;

class Save extends Contact
{
    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        //$data['image'] =$this->getRequest()->getFiles('image');


        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($data) {

            $contactModel = $this->_contactFactory->create();
            $id = $this->getRequest()->getParam('id');

            if ($id) {
                $contactModel->load($id);
            }

            // save image data and remove from data array
            if (isset($data['image'])) {
                $imageData = $data['image'];
                unset($data['image']);
            } else {
                $imageData = array();
            }


            $contactModel->addData($data);

            $this->_eventManager->dispatch(
                'contact_contact_prepare_save',
                ['contact' => $contactModel, 'request' => $this->getRequest()]
            );

            try {
                $imageHelper = $this->_objectManager->get('Lts\Contact\Helper\Data');

                if (isset($imageData['delete']) && $contactModel->getImage()) {
                    $imageHelper->removeImage($contactModel->getImage());
                    $contactModel->setImage(null);
                }

                $imageFile = $imageHelper->uploadImage('image');

                if ($imageFile) {
                    $contactModel->setImage($imageFile);
                }

                $contactModel->save();
                $this->messageManager->addSuccess(__('Contact Details Saved'));
                $this->_getSession()->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $contactModel->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the contact details'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['entity_id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
