<?php
/**
* Module Installation script
*
* @author Supertron
*/

$this->startSetup();
$this->getConnection()->addColumn(
    $this->getTable('sales/order_grid'),
    'shipping_method',
    "varchar(255) not null default ''"
);

$this->getConnection()->addKey(
    $this->getTable('sales/order_grid'),
    'IDX_SHIPPING_METHOD',
    'shipping_method'
);
$select = $this->getConnection()->select();
$select->join(
    array('order_shipping'=>$this->getTable('sales/order')),
    $this->getConnection()->quoteInto(
        'order_shipping.entity_id = order_grid.entity_id',
    	Mage_Sales_Model_Quote_Address::TYPE_SHIPPING
    ),
    array('shipping_method' => 'shipping_method')
);
$this->getConnection()->query(
    $select->crossUpdateFromSelect(
        array('order_grid' => $this->getTable('sales/order_grid'))
    )
);
$this->endSetup();