<?php

class Sofia_Testimonials_Block_Adminhtml_Testimonials_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('sofia_testimonials_grid');
        $this->setDefaultSort('testimonial_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('sofia_testimonials/testimonials')->getCollection();
         //   ->join(array('a' => 'sales/order_address'), 'main_table.entity_id = a.parent_id AND a.address_type != \'billing\'', array(
         //       'city'       => 'city',
         //       'country_id' => 'country_id'
         //   ))
          //  ->join(array('c' => 'customer/customer_group'), 'main_table.customer_group_id = c.customer_group_id', array(
          //      'customer_group_code' => 'customer_group_code'
          //  ))
          /*  ->addExpressionFieldToSelect(
                'fullname',
                'CONCAT({{customer_firstname}}, \' \', {{customer_lastname}})',
                array('customer_firstname' => 'main_table.customer_firstname', 'customer_lastname' => 'main_table.customer_lastname'))
            ->addExpressionFieldToSelect(
                'products',
                '(SELECT GROUP_CONCAT(\' \', x.name)
                    FROM sales_flat_order_item x
                    WHERE {{entity_id}} = x.order_id
                        AND x.product_type != \'configurable\')',
                array('entity_id' => 'main_table.entity_id')
            )*/


        $this->setCollection($collection);
        parent::_prepareCollection();
        return $this;
    }

    protected function _prepareColumns()
    {
        $helper = Mage::helper('sofia_testimonials');

        $this->addColumn('testimonial_id', array(
            'header' => $helper->__('review #'),
            'index'  => 'testimonial_id'
        ));

        $this->addColumn('user_id', array(
            'header' => $helper->__('User Id'),
         //   'type'   => 'datetime',
            'index'  => 'user_id'
        ));

        $this->addColumn('Title', array(
            'header'       => $helper->__('Title'),
            'index'        => 'title',
            //'filter_index' => '(SELECT GROUP_CONCAT(\' \', x.name) FROM sales_flat_order_item x WHERE main_table.entity_id = x.order_id AND x.product_type != \'configurable\')'
        ));
        $this->addColumn('testimonial', array(
            'header' => $helper->__('Testimonial'),
         //   'type'   => 'datetime',
            'index'  => 'testimonial'
        ));
        $this->addColumn('image', array(
            'header' => $helper->__('Image'),
            'index'  => 'image',
            'width'     => '97',
            'renderer' => 'Sofia_Testimonials_Block_Adminhtml_Testimonials_Grid_Renderer_Image'
        ));
        $this->addColumn('timestamp', array(
            'header' => $helper->__('Date Created'),
            'index'  => 'timestamp'
        ));
$yesnoOptions = array('0' => 'No','1' => 'Yes','' => 'Any');

        $this->addColumn('enabled', array(
            'header' => $helper->__('Enabled'),
                     'index'  => 'enabled',

         'type'      => 'options',
         'options'   => $yesnoOptions,
               ));
               $this->addColumn('action',
                         array(
                             'header'    => Mage::helper('catalog')->__('Action'),
                             'width'     => '50px',
                             'type'      => 'action',
                             'getter'     => 'getTestimonialId',
                             'actions'   => array(
                                 array(
                                     'caption' => Mage::helper('catalog')->__('Edit'),
                                     'url'     => array(
                                         'base'=>'*/*/edit',
                                     ),
                                     'field'   => 'testimonialId'
                                 ),
                             ),

                             'filter'    => false,
                             'sortable'  => false,
                             'index'     => 'testimonial_id',
                         ));


        $this->addExportType('*/*/exportTestimonialsCsv', $helper->__('CSV'));
        $this->addExportType('*/*/exportTestimonialsExcel', $helper->__('Excel XML'));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
            $helper = Mage::helper('sofia_testimonials');

       $this->setMassactionIdField('testimonial_id');
              $this->getMassactionBlock()->setFormFieldName('id');

              $this->getMassactionBlock()->addItem('delete', array(
                   'label'    => $helper->__('Delete'),
                   'url'      => $this->getUrl('*/*/massDelete'),
                   'confirm'  => $helper->__('Are you sure?')
              ));

               $statuses = array('0' => 'Disable','1' => 'Enable');

                  //    array_unshift($statuses, array('label'=>'', 'value'=>''));
                      $this->getMassactionBlock()->addItem('status', array(
                           'label'=>$helper->__('Change status'),
                           'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
                           'additional' => array(
                                  'visibility' => array(
                                       'name' => 'status',
                                       'type' => 'select',
                                       'class' => 'required-entry',
                                       'label' => $helper->__('Status'),
                                       'values' => $statuses
                      )
                      )
                      ));
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }
}