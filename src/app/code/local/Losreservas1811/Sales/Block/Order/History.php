<?php
/**
 * Magento e-commerce
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 *
 * @category   Losreservas1811
 * @package    Losreservas1811_Sales
 * @copyright  Copyright (c) 2018 LOS RESERVAS 1811, SL (https://www.losreservas1811.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Sales Order History block
 *
 * @category   Losreservas1811
 * @package    Losreservas1811_Sales
 * @author     LOS RESERVAS 1811 Team <web@losreservas1811.com>
 */
class Losreservas1811_Sales_Block_Order_History extends Mage_Sales_Block_Order_History
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('losreservas1811_sales/order/history.phtml');

        $orders = Mage::getResourceModel('sales/order_collection')
            ->addFieldToSelect('*')
            ->addFieldToFilter('customer_id', Mage::getSingleton('customer/session')->getCustomer()->getId())
            ->addFieldToFilter('state', array('in' => Mage::getSingleton('sales/order_config')->getVisibleOnFrontStates()))
            ->setOrder('created_at', 'desc')
        ;

        $this->setOrders($orders);

        Mage::app()->getFrontController()->getAction()->getLayout()->getBlock('root')->setHeaderTitle(Mage::helper('sales')->__('My Orders'));
    }
}
