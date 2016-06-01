<?php

class Sofia_Testimonials_Adminhtml_TestimonialsController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_title($this->__('Sales'))->_title($this->__('Sofia Testimonials'));
        $this->loadLayout();
        $this->_setActiveMenu('sales/sales');
        $this->_addContent($this->getLayout()->createBlock('sofia_testimonials/adminhtml_testimonials'));
        $this->renderLayout();
    }

    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('sofia_testimonials/adminhtml_testimonials_grid')->toHtml()
        );
    }
    public function editAction()
    {
   $id= Mage::app()->getRequest()->getParam('testimonialId');
    //$id = $this->getRequest()->getParam('testimonial_id');
  //  var_dump($id);
    $this->loadLayout();
    $this->_addContent($this->getLayout()->createBlock('testimonials/adminhtml_form'))
     ->_addLeft($this->getLayout()->createBlock('testimonials/adminhtml_form_edit_tabs'));
$this->renderLayout();
    }


    public function saveAction()
    {

  $params= Mage::app()->getRequest()->getParams();
   //     var_dump($_FILES['testimonialimg']);
    $customer = Mage::getSingleton('customer/session')->getCustomer();

$imagePath="";
    if (isset($_FILES['testimonialimg']['name']) && $_FILES['testimonialimg']['name'] != '') {
        try {
            $uploader = new Varien_File_Uploader('testimonialimg');
            $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));
            $uploader->setAllowRenameFiles(false);
            $uploader->setFilesDispersion(false);
            $path = Mage::getBaseDir('media') . DS .'testimonials'. DS;
            // $path = Mage::getBaseDir('media') . DS . 'logo' . DS;
            $logoName = $_FILES['testimonialimg']['name'];
            $uploader->save($path, $logoName);
            $imagePath=$uploader->getUploadedFileName();

        } catch (Exception $e) {
        Mage::getSingleton('core/session')->addError('Error uploading image');
        }
	}


              if ($data = $this->getRequest()->getPost()) {
                    //init model and set data
                    $model = Mage::getModel('sofia_testimonials/testimonials');
                    if ($id = $this->getRequest()->getParam('id')) {//the parameter name may be different
                        $model->load($id);
                    }
                    $model->setTitle($data['title']);
                    $model->setUserId($customer->getId());
                    $model->setUserName($customer->getName());
                    $model->setTestimonial($data['testimonial']);
                    if(array_key_exists('enabled', $data)){
                    $model->setEnabled('1');
                    }
                    else{
                    $model->setEnabled('0');
                    }
                    if ($imagePath != ""){
                    $model->setImage($imagePath);
                    }
                    try{
                        //try to save it
                        $model->save();
                        $this->_redirect('*/*/');
                        }
                    catch (Exception $e){
                    echo "Error!!!";
                        //if there is an error return to edit
                    }
                }


        $this->_redirect('*/*/index');
    }




    public function massdeleteAction()
    {
        $id= Mage::app()->getRequest()->getParams();
        var_dump($id);
        $testimonialIds = $this->getRequest()->getParam('id');

        if(!is_array($testimonialIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('sofia_testimonials')->__('Please select testimonials to delete.'));
        }
        else {
            try {
                $testiModel = Mage::getModel('sofia_testimonials/testimonials');
                foreach ($testimonialIds as $Ids) {
                    $testiModel->load($Ids)->delete();
                }

                Mage::getSingleton('adminhtml/session')->addSuccess(

                Mage::helper('sofia_testimonials')->__(
                'Total of %d record(s) were deleted.', count($testimonialIds)
                )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }

        $this->_redirect('*/*/index');
    }

    public function massStatusAction()
    {
        $id= Mage::app()->getRequest()->getParams();
        var_dump($id);
        $testimonialIds = $this->getRequest()->getParam('id');
        $status = $this->getRequest()->getParam('status');

        if(!is_array($testimonialIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('sofia_testimonials')->__('Please select testimonials to delete.'));
        }
        else {
            try {
                $model = Mage::getModel('sofia_testimonials/testimonials');
                $resource = $model->getResource();

                $resource->beginTransaction();
                foreach ($testimonialIds as $Ids) {
                    $model->load($Ids)->setEnabled($status)->save();
                }
                $resource->commit();


                Mage::getSingleton('adminhtml/session')->addSuccess(

                Mage::helper('sofia_testimonials')->__(
                'Total of %d record(s) were updated.', count($testimonialIds)
                )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }

        $this->_redirect('*/*/index');
    }


    public function exportTestimonialsCsvAction()
    {
        $fileName = 'testimonials.csv';
        $grid = $this->getLayout()->createBlock('sofia_testimonials/adminhtml_testimonials_grid');
        $this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
    }

    public function exportTestimonialsExcelAction()
    {
        $fileName = 'testimonials.xml';
        $grid = $this->getLayout()->createBlock('sofia_testimonials/adminhtml_testimonials_grid');
        $this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
    }
}
