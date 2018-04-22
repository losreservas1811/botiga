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
 * Pdf Order Invoice PDF model
 *
 * @category   Losreservas1811
 * @package    Losreservas1811_Pdf
 * @author     LOS RESERVAS 1811 Team <web@losreservas1811.com>
 */
class Losreservas1811_Pdf_Model_Order_Pdf_Invoice extends Mage_Sales_Model_Order_Pdf_Invoice
{
    /**
     * Return PDF document
     *
     * @param  array $invoices
     * @return Zend_Pdf
     */
    public function getPdf($invoices = array())
    {
        $this->_beforeGetPdf();
        $this->_initRenderer('invoice');

        $pdf = new Zend_Pdf();
        $this->_setPdf($pdf);
        $style = new Zend_Pdf_Style();
        $this->_setFontBold($style, 10);

        /** 
         * @var $invoice \Mage_Sales_Model_Order_Invoice 
         */
        foreach ($invoices as $invoice) {
            /*
             * Not necessary to maintain PDF on each customer language
            if ($invoice->getStoreId()) {
                Mage::app()->getLocale()->emulate($invoice->getStoreId());
                Mage::app()->setCurrentStore($invoice->getStoreId());
            }
             * 
             */
            $page  = $this->newPage();
            /**
             * @var $order \Mage_Sales_Model_Order
             */
            $order = $invoice->getOrder();
            /* Add image */
            $this->insertLogo($page, $invoice->getStore());
            /* Add address */
            $this->insertAddress($page, $invoice->getStore());
            /* Add head */
            $this->insertOrder(
                $page,
                $order,
                Mage::getStoreConfigFlag(self::XML_PATH_SALES_PDF_INVOICE_PUT_ORDER_ID, $order->getStoreId())
            );
            /* Add document text and number */
            $this->insertDocumentNumber(
                $page,
                Mage::helper('sales')->__('Invoice # ') . $invoice->getIncrementId()
            );
            /* Add table */
            $this->_drawHeader($page);
            /* Add body */
            foreach ($invoice->getAllItems() as $item) {
                if ($item->getOrderItem()->getParentItem()) {
                    continue;
                }
                /* Draw item */
                $this->_drawItem($item, $page, $order);
                $page = end($pdf->pages);
            }
            unset($item);
            /* Add totals */
            $this->insertTotals($page, $invoice);
            /*
             * Not necessary to maintain PDF on each customer language
            if ($invoice->getStoreId()) {
                Mage::app()->getLocale()->revert();
            }
             * 
             */
        }
        $this->_afterGetPdf();
        return $pdf;
    }
}
