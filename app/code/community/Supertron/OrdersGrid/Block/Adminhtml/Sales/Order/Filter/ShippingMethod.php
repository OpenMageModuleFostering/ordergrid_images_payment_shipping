<?php
class Supertron_OrdersGrid_Block_Adminhtml_Sales_Order_Filter_ShippingMethod extends Mage_Adminhtml_Block_Widget_Grid_Column_Filter_Select
{
    protected function _getOptions()
    {
		
	   
         $methods = array(array('value'=>'','label'=>Mage::helper('adminhtml')->__('--Please Select--')));

        $activeCarriers = Mage::getSingleton('shipping/config')->getActiveCarriers();
        foreach($activeCarriers as $carrierCode => $carrierModel)
        {
           $options = array();
           if( $carrierMethods = $carrierModel->getAllowedMethods() )
           {
               foreach ($carrierMethods as $methodCode => $method)
               {
                    $code= $carrierCode.'_'.$methodCode;
                    $options[]=array('value'=>$code,'label'=>$method);

               }
               $carrierTitle = Mage::getStoreConfig('carriers/'.$carrierCode.'/title');

           }
            $methods[]=array('value'=>$options,'label'=>$carrierTitle);
        }
        return $methods;
    }
}