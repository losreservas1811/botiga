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
 * @package    Losreservas1811_Customer
 * @copyright  Copyright (c) 2018 LOS RESERVAS 1811, SL (https://www.losreservas1811.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Customer Widget Gender block
 *
 * @category   Losreservas1811
 * @package    Losreservas1811_Customer
 * @author     LOS RESERVAS 1811 Team <web@losreservas1811.com>
 */
class Losreservas1811_Customer_Block_Widget_Gender extends Mage_Customer_Block_Widget_Gender
{
    /**
     * Initialize block
     */
    public function _construct()
    {
        parent::_construct();
        $this->setTemplate('losreservas1811_customer/widget/gender.phtml');
    }
}
