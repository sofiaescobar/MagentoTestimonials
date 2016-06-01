<?php
class Sofia_Testimonials_Model_Resource_Testimonials_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract {

    protected function _construct()
    {
            $this->_init('sofia_testimonials/testimonials');
    }
}