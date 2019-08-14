<?php 
class Supertron_OrdersGrid_Block_Adminhtml_Sales_Order_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
	
    public function render(Varien_Object $row)
    {
        return $this->_getValue($row);
    } 
    protected function _getValue(Varien_Object $row)
    { 	
	    $items    =   $row->getData('Productid');
		$order    =   $row->getData('increment_id');
	    $item_ids =  explode(",",$items);
		$out = '<script type="text/javascript">
jQuery.noConflict();
jQuery(document).ready(function(){
	jQuery("#slider"+'.$order.').tinycarousel({display: 2});		
});
</script><div id="slider'.$order.'" class="slider">
					<a class="buttons prev" href="#">left</a>
					  <div class="viewport" style="width:270px">
						<ul class="overview">';
		$flag = false;
		for($i = 0; $i < count($item_ids);$i++) {
		   $product = Mage::getModel('catalog/product')->load($item_ids[$i]);
		  
		 if( ($product->getThumbnail() != "no_selection") && ($product->getThumbnail() != '') ) {
			$full_path_url = Mage::helper('catalog/image')->init($product, 'thumbnail');
			$out .= "<li><img src=". $full_path_url ." width='80px' height='80px'/></li>"; 
			$flag = true;
		 } 
         
		}
	   $out .= '</ul></div>
					<a class="buttons next" href="#">right</a>
				</div>';
      
	   $result .='';
       if($flag){
		$result .= $out;
	   } else {
		$resul .= "No Image";  
	   }
       return $result;
    }
}

?>