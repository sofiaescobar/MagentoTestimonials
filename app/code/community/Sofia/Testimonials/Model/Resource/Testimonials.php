<?php
/**
 * Created by PhpStorm.
 * User: fouf
 * Date: 5/28/16
 * Time: 9:49 PM
 */

  class Sofia_Testimonials_Model_Resource_Testimonials extends Mage_Core_Model_Resource_Db_Abstract{
        protected function _construct()
        {
            $this->_init('sofia_testimonials/testimonials', 'testimonial_id');
        }
    }