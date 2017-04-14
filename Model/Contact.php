<?php
/**
 * Created by PhpStorm.
 * User: Lozingle
 * Date: 11/04/2017
 * Time: 03:01 PM
 */
namespace Lts\Contact\Model;

use \Magento\Framework\Model\AbstractModel;

class Contact extends AbstractModel
{
    const CONTACT_ID = 'entity_id';

    const BASE_MEDIA_PATH = 'lts/employee/images';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'contact';

    /**
     * Name of the event object
     *
     * @var string
     */
    protected $_eventObject = 'contact';

    /**
     * Name of object id field
     *
     * @var string
     */
    protected $_idFieldName = self::CONTACT_ID;

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Lts\Contact\Model\ResourceModel\Contact');
    }

    public function getEnableStatus() {
        return 1;
    }

    public function getDisableStatus() {
        return 0;
    }

}