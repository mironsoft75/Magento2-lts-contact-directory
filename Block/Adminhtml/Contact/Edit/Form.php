<?php
/**
 * Created by PhpStorm.
 * User: Lozingle
 * Date: 11/04/2017
 * Time: 05:15 PM
 */
namespace Lts\Contact\Block\Adminhtml\Contact\Edit;

use \Magento\Backend\Block\Widget\Form\Generic;

class Form extends Generic
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    protected $_wysiwygConfig;

    protected $_status;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        \Lts\Contact\Model\Source\Status $status,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        $this->_status = $status;
        $this->_wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Init form
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('contact_form');
        $this->setTitle(__('Employee Information'));
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        /** @var \Lts\Contact\Model\Contact $model */
        $model = $this->_coreRegistry->registry('contact_contact');

        /** @var \Magento\Framework\Data\Form $form */

        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post','enctype' => 'multipart/form-data']]
        );

        $form->setHtmlIdPrefix('employee_');

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Contact Information'), 'class' => 'fieldset-wide']);

        if ($model->getId()) {
            $fieldset->addField('entity_id', 'hidden', ['name' => 'entity_id']);
        }

        $fieldset->addField(
            'name',
            'text',
            ['name' => 'name', 'label' => __('Employee Name'), 'title' => __('Employee Name'), 'required' => true]
        );

        $fieldset->addField(
            'phoneNo',
            'text',
            ['name' => 'phoneNo', 'label' => __('Employee Contact No'), 'title' => __('Employee Contact No'), 'required' => true]
        );

        if (!$model->getId()) {
            $model->setDate(date('Y-m-d'));
        }
        $fieldset->addField(
            'join_date',
            'date',
            ['name' => 'join_date', 'label' => __('Date of Join'), 'title' => __('Date of Join'), 'required' => true, 'date_format' => 'Y-MM-dd']
        );

        $fieldset->addField(
            'image',
            'image',
            [ 'title' => __('Image Upload'),'label' => __('Image Upload'),'name' => 'image','note' => 'Allow image type: jpg, jpeg, gif, png']
        );

        if (!$model->getId()) {
            $model->setStatus('1');
        }
        $statuses = $this->_status->toOptionArray();
        $fieldset->addField(
            'status',
            'select',
            ['name' => 'status', 'label' => __('Status'), 'title' => __('Status'), 'required' => true, 'values' => $statuses]
        );

        $fieldset->addField(
            'description',
            'editor',
            ['name' => 'description', 'label' => __('Description'), 'title' => __('Description'), 'required' => false, 'config' => $this->_wysiwygConfig->getConfig()]
        );

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}