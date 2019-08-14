<?php
/**
 * Event observer model
 @author Supertron
 */
class Supertron_OrdersGrid_Model_Observer
{

    public function addColumnToResource(Varien_Event_Observer $observer)
    {
        $resource = $observer->getEvent()->getResource();
        $resource->addVirtualGridColumn(
            'payment_method',
            'sales/order_payment',
            array('entity_id' => 'parent_id'),
            'method'
        );
		
    }
}