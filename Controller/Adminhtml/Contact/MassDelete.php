<?php
/**
 * Created by PhpStorm.
 * User: Lozingle
 * Date: 12/04/2017
 * Time: 11:05 AM
 */
namespace Lts\Contact\Controller\Adminhtml\Contact;

use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Lts\Contact\Model\ResourceModel\Contact\CollectionFactory;
use Magento\Framework\Controller\ResultFactory;

/**
 * Class MassDisable
 */

class MassDelete  extends \Magento\Backend\App\Action
{
    /**
     * @var Filter
     */
    protected $filter;
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;
    /**
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(Context $context, Filter $filter, CollectionFactory $collectionFactory)
    {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }
    /**
     * Execute action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException|\Exception
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $collectionSize = $collection->getSize();
        $connection = $collection->getConnection();
        $tableName = $connection->getTableName('a_lts_contacts');
        foreach ($collection->getAllIds() as $id) {
            $sql = "Delete FROM `" . $tableName."` Where `entity_id` = '".$id."'";
            $connection->query($sql);
        }
        $this->messageManager->addSuccess(__('A total of %1 record(s) have been deleted.', $collectionSize));
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}
