<?php
class Sofia_Testimonials_Block_Navigation extends Mage_Catalog_Block_Navigation
{

public function renderCategoriesMenuHtml($level = 0, $outermostItemClass = '', $childrenWrapClass = '')
{
// if route is active
$active = ($this->getRequest()->getRouteName()=='testimonials' ? 'active' : '');

// Get navigation menu html
$html = parent::renderCategoriesMenuHtml($level, $outermostItemClass, $childrenWrapClass);

// if module is active
if (Mage::helper('core/data')->isModuleEnabled('Sofia_Testimonials')) {
// Adding new menu item. You can also add few items or child elements there
$html .=  "<li class=level$level $active'><a class='$outermostItemClass' href='" . Mage::getUrl('testimonials/Testimonials/index') . "'>" . Mage::helper('sofia_testimonials')->__('Testimonials') . "</a></li>";
}
return $html;
}

}