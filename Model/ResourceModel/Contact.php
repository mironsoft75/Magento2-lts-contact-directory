<?php
/**
 * Created by PhpStorm.
 * User: Lozingle
 * Date: 11/04/2017
 * Time: 03:08 PM
 */
namespace Lts\Contact\Model\ResourceModel;

use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Contact post mysql resource
 */
class Contact extends AbstractDb
{

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        // Table Name and Primary Key column
        $this->_init('a_lts_contacts', 'entity_id');
    }

}