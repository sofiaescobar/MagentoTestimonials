<?php

class Sofia_Testimonials_TestimonialsController extends Mage_Core_Controller_Front_Action
{

    /**
     */
    public function indexAction()
    {
       $this->loadLayout();
       $this->renderLayout();
    }

    public function saveTestimonialAction(){
        if(Mage::getSingleton('customer/session')->isLoggedIn()){

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
                    $model->setEnabled('1');
                    $model->setImage($imagePath);

                    try{
                        //try to save it
                        $model->save();
                        $this->_redirect('*/*/');
                        }
                    catch (Exception $e){
                 //   echo "Error!!!";
                        //if there is an error return to edit
                    }
                }
         }
                 else{
                    Mage::getSingleton('core/session')->addError('Please Login to add Testimonials');

                   }

        $this->_redirect('*/*/index');

    }


    /**
     * Set redirect into response. This has to be encapsulated in an JavaScript
     * call to jump out of the iframe.
     *
     * @param string $path
     * @param array $arguments
     */
    protected function _redirect($path, $arguments=array())
    {
        $this->getResponse()->setBody(
            $this->getLayout()
                ->createBlock('moneybookers/redirect')
                ->setRedirectUrl(Mage::getUrl($path, $arguments))
                ->toHtml()
        );
        return $this;
    }
}
