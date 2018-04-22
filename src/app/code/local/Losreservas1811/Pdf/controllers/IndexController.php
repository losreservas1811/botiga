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
 * @package    Losreservas1811_Pdf
 * @copyright  Copyright (c) 2018 LOS RESERVAS 1811, SL (https://www.losreservas1811.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Pdf Index controller
 *
 * @category   Losreservas1811
 * @package    Losreservas1811_Pdf
 * @author     LOS RESERVAS 1811 Team <web@losreservas1811.com>
 */
class Losreservas1811_Pdf_IndexController extends Mage_Core_Controller_Front_Action
{
    /**
     * Invoice action
     * 
     * @return type
     */
    public function invoiceAction() 
    {
        $orderId = (int) $this->getRequest()->getParam('order_id');
        /**
         * @var $order \Mage_Sales_Model_Order
         */
        $order = Mage::getModel('sales/order')->load($orderId);

        if ($this->_canViewOrder($order)) {
            $invoices = Mage::getResourceModel('sales/order_invoice_collection')
                    ->setOrderFilter($order->getId())
                    ->load();
            if ($invoices->getSize() > 0) {
                /** 
                 * @var $pdf \Mage_Sales_Model_Order_Pdf_Invoice 
                 */
                $pdf = Mage::getModel('losreservas1811_pdf/order_pdf_invoice')->getPdf($invoices);

                return $this->_prepareDownloadResponse(
                    $this->__('Invoice_from_Order').'_'.$order->getIncrementId().'.pdf', $pdf->render(),
                    'application/pdf'
                );

            }
        }
    }

    /**
     * Can view Order?
     * 
     * @param \Mage_Sales_Model_Order $order
     * @return boolean
     */
    protected function _canViewOrder($order)
    {
        $customerId = Mage::getSingleton('customer/session')->getCustomerId();
        $availableStates = Mage::getSingleton('sales/order_config')->getVisibleOnFrontStates();
        
        if ($order->getId() && $order->getCustomerId() && ($order->getCustomerId() == $customerId)
            && in_array($order->getState(), $availableStates, $strict = true)
            ) {
            if ($this->_invoiceGenerated($order)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Order has Invoice generated?
     * 
     * @param \Mage_Sales_Model_Order $order
     * @return boolean
     */
    protected function _invoiceGenerated($order)
    {
        $return = false;

        $invoices = $order->hasInvoices();
        if (!empty($invoices)) {
            $return = true;
        }
        
        return $return;
    }
}
