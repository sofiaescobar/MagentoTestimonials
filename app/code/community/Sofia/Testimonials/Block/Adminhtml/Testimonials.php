<?php
 
class Sofia_Testimonials_Block_Adminhtml_Testimonials extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'sofia_testimonials';
        $this->_controller = 'adminhtml_testimonials';
        $this->_headerText = Mage::helper('sofia_testimonials')->__('Testimonials - Sofia');
        parent::__construct();
        $this->_removeButton('add');
    }
}