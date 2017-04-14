<?php
/**
 * Created by PhpStorm.
 * User: Lozingle
 * Date: 11/04/2017
 * Time: 03:10 PM
 */
namespace Lts\Contact\Model\ResourceModel\Contact;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    //protected $_idFieldName = \Lts\Contact\Model\Contact::CONTACT_ID;
    protected $_idFieldName = 'entity_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Lts\Contact\Model\Contact', 'Lts\Contact\Model\ResourceModel\Contact');
    }

}
