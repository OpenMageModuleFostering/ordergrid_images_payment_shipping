<?php
 
/**
* Module Installation script
*
* @author Supertron
*/

$this->startSetup();
$this->getConnection()->addColumn(
    $this->getTable('sales/order_grid'),
    'payment_method',
    "varchar(255) not null default ''"
);

$this->getConnection()->addKey(
    $this->getTable('sales/order_grid'),
    'IDX_PAYMENT_METHOD',
    'payment_method'
);
$select = $this->getConnection()->select();
$select->join(
    array('order_payment'=>$this->getTable('sales/order_payment')),
    $this->getConnection()->quoteInto(
        'order_payment.parent_id = order_grid.entity_id',
    	Mage_Sales_Model_Quote_Address::TYPE_BILLING
    ),
    array('payment_method' => 'method')
);
$this->getConnection()->query(
    $select->crossUpdateFromSelect(
        array('order_grid' => $this->getTable('sales/order_grid'))
    )
);
$this->endSetup();