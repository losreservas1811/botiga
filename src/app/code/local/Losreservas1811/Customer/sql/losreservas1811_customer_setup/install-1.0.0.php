<?php
$installer = $this;
$installer->startSetup();

$installer->addAttribute(
    "customer_address",
    "is_company",
    array(
        "type"     => "int",
        "backend"  => "",
        "label"    => "Is company?",
        "input"    => "select",
        "source"   => "eav/entity_attribute_source_boolean",
        "visible"  => true,
        "required" => false,
        "default"  => "0",
        "frontend" => "",
        "unique"   => false,
        "note"     => ""
    )
);

$attribute = Mage::getSingleton("eav/config")->getAttribute("customer_address", "is_company");


$used_in_forms = array();

$used_in_forms[] = "adminhtml_customer_address";
$used_in_forms[] = "customer_register_address";
$used_in_forms[] = "customer_address_edit";
$attribute->setData("used_in_forms", $used_in_forms)
    ->setData("is_used_for_customer_segment", true)
    ->setData("is_system", 0)
    ->setData("is_user_defined", 1)
    ->setData("is_visible", 1)
    ->setData("sort_order", 100);
$attribute->save();



$installer->addAttribute(
    "customer_address",
    "cif_nif_nie",
    array(
        "type"     => "varchar",
        "backend"  => "",
        "label"    => "CIF / NIF / NIE",
        "input"    => "text",
        "source"   => "",
        "visible"  => true,
        "required" => true,
        "default"  => "",
        "frontend" => "",
        "unique"   => false,
        "note"     => ""
    )
);

$attribute = Mage::getSingleton("eav/config")->getAttribute("customer_address", "cif_nif_nie");

$used_in_forms = array();

$used_in_forms[] = "adminhtml_customer_address";
$used_in_forms[] = "customer_register_address";
$used_in_forms[] = "customer_address_edit";
$attribute->setData("used_in_forms", $used_in_forms)
    ->setData("is_used_for_customer_segment", true)
    ->setData("is_system", 0)
    ->setData("is_user_defined", 1)
    ->setData("is_visible", 1)
    ->setData("sort_order", 100);
$attribute->save();



$tablequote = $this->getTable('sales/quote_address');
$installer->run("ALTER TABLE  $tablequote ADD `is_company` tinyint unsigned default 0");
$installer->run("ALTER TABLE  $tablequote ADD `cif_nif_nie` char(9) NOT NULL");
 
$tablequote = $this->getTable('sales/order_address');
$installer->run("ALTER TABLE  $tablequote ADD `is_company` tinyint unsigned default 0");
$installer->run("ALTER TABLE  $tablequote ADD `cif_nif_nie` char(9) NOT NULL");



$installer->endSetup();
