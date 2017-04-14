<?php
/**
 * Created by PhpStorm.
 * User: Lozingle
 * Date: 11/04/2017
 * Time: 05:00 PM
 */
namespace Lts\Contact\Controller\Adminhtml\Contact;

use Lts\Contact\Controller\Adminhtml\Contact;

class Add extends Contact
{

    public function execute()
    {
        $this->_forward('edit');
    }
}
