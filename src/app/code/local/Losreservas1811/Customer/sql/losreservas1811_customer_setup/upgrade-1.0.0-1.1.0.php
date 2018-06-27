<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magento.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magento.com for more information.
 *
 * @category    Losreservas1811
 * @package     Losreservas1811_Customer
 * @copyright  Copyright (c) 2018 Los Reservas 1811, SL (http://www.losreservas1811.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/* @var $installer Mage_Customer_Model_Entity_Setup */
$installer = $this;
$installer->startSetup();

try {
    /* Accept Cookies */
    $entity = $installer->getEntityTypeId('customer');
    $installer->addAttribute(
        $entity, 
        'accept_cookies', 
        array(
            "type"     => "int",
            "backend"  => "",
            "label"    => "Accept Cookies",
            "input"    => "select",
            "source"   => "eav/entity_attribute_source_boolean",
            "visible"  => true,
            "required" => true,
            "default"  => "0",
            "frontend" => "",
            "unique"   => false,
            "note"     => ""
        )
    );

    $forms = array(
        'adminhtml_customer',
        'customer_account_edit',
        'checkout_register',
        'customer_account_create',
    );
    $attribute = Mage::getSingleton('eav/config')->getAttribute($installer->getEntityTypeId('customer'), 'accept_cookies');
    $attribute->setData('used_in_forms', $forms);
    $attribute->save();


    /* Accept Account */
    $entity = $installer->getEntityTypeId('customer');
    $installer->addAttribute(
        $entity, 
        'accept_account', 
        array(
            "type"     => "int",
            "backend"  => "",
            "label"    => "Accept Account",
            "input"    => "select",
            "source"   => "eav/entity_attribute_source_boolean",
            "visible"  => true,
            "required" => true,
            "default"  => "0",
            "frontend" => "",
            "unique"   => false,
            "note"     => ""
        )
    );

    $forms = array(
        'adminhtml_customer',
        'customer_account_edit',
        'checkout_register',
        'customer_account_create',
    );
    $attribute = Mage::getSingleton('eav/config')->getAttribute($installer->getEntityTypeId('customer'), 'accept_account');
    $attribute->setData('used_in_forms', $forms);
    $attribute->save();


    /* Accept Privacy Policy */
    $entity = $installer->getEntityTypeId('customer');
    $installer->addAttribute(
        $entity, 
        'accept_privacypolicy', 
        array(
            "type"     => "int",
            "backend"  => "",
            "label"    => "Accept Privacy Policy",
            "input"    => "select",
            "source"   => "eav/entity_attribute_source_boolean",
            "visible"  => true,
            "required" => true,
            "default"  => "0",
            "frontend" => "",
            "unique"   => false,
            "note"     => ""
        )
    );

    $forms = array(
        'adminhtml_customer',
        'customer_account_edit',
        'checkout_register',
        'customer_account_create',
    );
    $attribute = Mage::getSingleton('eav/config')->getAttribute($installer->getEntityTypeId('customer'), 'accept_privacypolicy');
    $attribute->setData('used_in_forms', $forms);
    $attribute->save();
} catch (Exception $e) {
    Mage::logException($e);
}

$installer->endSetup();
