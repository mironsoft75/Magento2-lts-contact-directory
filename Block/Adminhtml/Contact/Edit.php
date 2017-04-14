<?php
/**
 * Created by PhpStorm.
 * User: Lozingle
 * Date: 11/04/2017
 * Time: 04:31 PM
 */
namespace Lts\Contact\Block\Adminhtml\Contact;

use Magento\Backend\Block\Widget\Form\Container;

class Edit extends Container
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * Contact edit block
     *
     * @return void
     */
    protected function _construct()
    {

        $this->_objectId = 'entity_id';
        $this->_blockGroup = 'Lts_Contact';
        $this->_controller = 'adminhtml_contact';

        parent::_construct();

        if ($this->_isAllowedAction('Lts_Contact::contact_save')) {
            $this->buttonList->update('save', 'label', __('Save Contact'));
            $this->buttonList->add(
                'saveandcontinue',
                [
                    'label' => __('Save and Continue Edit'),
                    'class' => 'save',
                    'data_attribute' => [
                        'mage-init' => [
                            'button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form'],
                        ],
                    ]
                ],
                -100
            );
        } else {
            $this->buttonList->remove('save');
        }

    }

    /**
     * Get header with Contact name
     *
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {


        if ($this->_coreRegistry->registry('contact_contact')->getId()) {
            return __("Edit Contact '%1'", $this->escapeHtml($this->_coreRegistry->registry('contact_contact')->getName()));
        } else {
            return __('New Contact');
        }
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }

    /**
     * Getter of url for "Save and Continue" button
     * tab_id will be replaced by desired by JS later
     *
     * @return string
     */
    protected function _getSaveAndContinueUrl()
    {
        return $this->getUrl('contact/*/save', ['_current' => true, 'back' => 'edit', 'active_tab' => '']);
    }
}
