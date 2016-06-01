<?php
class Sofia_Testimonials_Block_Adminhtml_Form_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
                $helper = Mage::helper('sofia_testimonials');

        $form = new Varien_Data_Form(array(
                                                         'id' => 'edit_form',
                                                         'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('testimonialId'))),
                                                         'method' => 'post',
                                                         'enctype' => 'multipart/form-data'

                                                          ));
        $model = Mage::getModel('sofia_testimonials/testimonials')->load($this->getRequest()->getParam('testimonialId'));
        $form->setUseContainer(true);
        $this->setForm($form);
        $fieldset = $form->addFieldset('form_form',               array('legend'=>$helper->__('Item information')));
        $fieldset->addField('user_id', 'text', array(
          'label'     => $helper->__('User Id'),
       //   'class'     => 'required-entry',
          'value' => $model->getUserId(),
          'readonly' => 'readonly',
          'required'  => true,
          'name'      => 'userId',
        ));
         $fieldset->addField('user_name', 'text', array(
                  'label'     => $helper->__('User Name'),
               //   'class'     => 'required-entry',
                  'value' => $model->getUserName(),
                //  'readonly' => 'readonly',
                  'required'  => true,
                  'name'      => 'title',
                ));
        $fieldset->addField('title', 'text', array(
          'label'     => $helper->__('Title'),
       //   'class'     => 'required-entry',
          'value' => $model->getTitle(),
          'required'  => false,
          'name'      => 'title',
        ));

        $fieldset->addField('testimonial', 'textarea', array(
          'label'     => $helper->__('Testimonial'),
          'class'     => 'required-entry',
          'value' => $model->getTestimonial(),
          'required'  => true,
          'name'      => 'testimonial',
        ));

        $fieldset->addField('enabled', 'checkbox', array(
          'label'     => $helper->__('Enabled'),
          'value' => $model->getEnabled(),

      //    'class'     => 'false',
          'required'  => false,
          'name'      => 'enabled',
        ));

        $fieldset->addField('testimonialimg', 'image', array(
          'label'     => $helper->__('Image'),
          'required'  => false,
          'name'      => 'testimonialimg',
        ));



        return parent::_prepareForm();
    }
}
