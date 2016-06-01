<?php
class Sofia_Testimonials_Block_Adminhtml_Form_Edit_Tabs_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
                $helper = Mage::helper('sofia_testimonials');

        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('form_form',               array('legend'=>$helper->__('Item information')));

        $fieldset->addField('title', 'text', array(
          'label'     => $helper->__('Title'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
        ));

        return parent::_prepareForm();
    }
}
