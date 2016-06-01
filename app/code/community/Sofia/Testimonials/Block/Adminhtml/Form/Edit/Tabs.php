<?php
class Sofia_Testimonials_Block_Adminhtml_Form_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      $helper = Mage::helper('sofia_testimonials');
      parent::__construct();
      $this->setId('form_tabs');
      $this->setDestElementId('form'); // this should be same as the form id define above
      $this->setTitle($helper->__('Product Information'));
  }

  protected function _beforeToHtml()
  {
        $helper = Mage::helper('sofia_testimonials');

      $this->addTab('form_section', array(
          'label'     => $helper->__('Item Information'),
          'title'     => $helper->__('Item Information'),
//          'content'   => $this->getLayout()->createBlock('testimonials/adminhtml_form_edit_tabs_form')->toHtml(),
      ));

      return parent::_beforeToHtml();
  }
}
