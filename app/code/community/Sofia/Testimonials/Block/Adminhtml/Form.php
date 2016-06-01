<?php
class Sofia_Testimonials_Block_Adminhtml_Form extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
            $helper = Mage::helper('sofia_testimonials');

        $this->_objectId = 'id';
        $this->_blockGroup = 'testimonials';
        $this->_controller = 'adminhtml_form';


    }

    public function getHeaderText()
    {
        $helper = Mage::helper('sofia_testimonials');

        return $helper->__('Edit Testimonials');
    }
}
