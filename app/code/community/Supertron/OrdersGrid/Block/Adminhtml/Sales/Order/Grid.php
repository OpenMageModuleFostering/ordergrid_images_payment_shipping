<?php
/**
* Sales Order Class
*
* @author Supertron
*/
class Supertron_OrdersGrid_Block_Adminhtml_Sales_Order_Grid extends Mage_Adminhtml_Block_Sales_Order_Grid
{
  public function __construct()
  {
	  
       parent::__construct();
       //$this->setId('supertron_adminhtml_block_sales_order_grid');//
	   $helper = Mage::helper('ordersgrid/data')->addscript();
  }

  //protected function setCollection($collection)
  public function setCollection($collection)
  {
	  /**
		* Sales Order Collection Grid

		*/
        $collection->join(
                'sales/order_item',
                '`sales/order_item`.order_id=`main_table`.entity_id',
                array(
                    'Productid'  => new Zend_Db_Expr('group_concat(`sales/order_item`.product_id SEPARATOR ",")'),
                    
                    )
                );
		$collection->getSelect()->group('main_table.entity_id');
        parent::setCollection($collection);
    }

   protected function _prepareColumns()
    {
        /**
		* Sales Order Grid Column

		*/
       
       $this->addColumn('image', array(
            'header' => Mage::helper('catalog')->__('Image'),
            'align' => 'left',
            'index' => 'image',
            'width'     => '70',
			'filter'    => false,
            'sortable'  => false,
          'renderer' => 'Supertron_OrdersGrid_Block_Adminhtml_Sales_Order_Renderer_Image',
        ));

        parent::_prepareColumns();
        return Mage_Adminhtml_Block_Widget_Grid::_prepareColumns();
       
    }
}
?>