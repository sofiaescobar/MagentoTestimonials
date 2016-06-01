<?php
class Sofia_Testimonials_Block_Adminhtml_Testimonials_Grid_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $val = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA).'testimonials/'.$row['image'];
        if($row['image']!=''){
            $out = "<img src=". $val ." width='97px'/>";
            }
        else{
            $url =Mage::getSingleton('catalog/product_media_config')->getBaseMediaUrl(). '/placeholder/' .Mage::getStoreConfig("catalog/placeholder/small_image_placeholder");;

            $out = "<img src=". $url ." width='97px'/>";

        }
        return $out;
    }
}