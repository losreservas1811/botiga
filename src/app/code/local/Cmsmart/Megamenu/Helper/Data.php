<?php

/*
 * Name Extension: Cmsmart megamenu
 * Author: The Cmsmart Development Team
 * Date Created: 06/09/2013
 * Websites: http://cmsmart.net
 * Technical Support: Forum - http://cmsmart.net/support
 * GNU General Public License v3 (http://opensource.org/licenses/GPL-3.0)
 * Copyright (c) 2011-2013 Cmsmart.net. All Rights Reserved.
 */

class Cmsmart_Megamenu_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * 
     * @return type
     */
    public function getAllOptions()
    {
        $this->_options = null;
        if (!$this->_options) {
            $this->_options = Mage::getResourceModel('cms/block_collection')
                ->load()
                ->toOptionArray();
            array_unshift(
                $this->_options, 
                array('value' => '', 'label' => Mage::helper('catalog')->__('Please select static block ...'))
            );
        }
        return $this->_options;
    }

    /**
     * 
     * @return type
     */
    public function getCategoryArr()
    {
        $categoryArr = $this->_categotyFilter();
        return $categoryArr;
    }

    /**
     *
     * @param type $id
     * @return type
     */
    public function Megamenu($id)
    {
        $categoryArr = $this->_categotyblock($id);
        return $categoryArr;
    }

    /**
     * 
     * @return type
     */
    public function getCategory()
    {
        return Mage::registry('current_category');
    }

    /**
     * 
     * @return string
     */
    public function toOptionArray()
    {
        $children = $this->getCategory()->getChildren();
        $cchildren = explode(",", $children);
        $count = count($cchildren);
        $data = array();

        if ($children) {
            for ($i = 1; $i <= $count; $i++) {
                $data['value'] = $i;
                $data['label'] = $i . ' Columns';
                $dat[] = $data;
            }
            return $dat;
        } else {
            return;
        }
    }

    /**
     * 
     * @return type
     */
    public function _categotyFilter()
    {
        $categoryId = $this->getCategory()->getId();
        $storeId = Mage::app()->getRequest()->getParam('store');
        $categoryFilterCollections = Mage::getModel('megamenu/megamenu')
            ->getCollection()
            ->addFieldToFilter('category_id', $categoryId)
            ->getData();

        $categoryFilterCollectionsAll = Mage::getModel('megamenu/megamenu')
            ->getCollection()
            ->addFieldToFilter('category_id', $categoryId)
            ->getData();

        if (count($categoryFilterCollections) > 0) {
            return $categoryFilterCollections;
        } else {
            return $categoryFilterCollectionsAll;
        }
    }

    /**
     *
     * @param type $id
     * @return type
     */
    public function _categotyblock($id)
    {
        $categoryId = $id;
        $storeId = Mage::app()->getRequest()->getParam('store');
        $categoryFilterCollections = Mage::getModel('megamenu/megamenu')
            ->getCollection()
            ->addFieldToFilter('category_id', $categoryId)
            ->getData();

        $categoryFilterCollectionsAll = Mage::getModel('megamenu/megamenu')
            ->getCollection()
            ->addFieldToFilter('category_id', $categoryId)
            ->getData();
        
        if (count($categoryFilterCollections) > 0) {
            return $categoryFilterCollections;
        } else {
            return $categoryFilterCollectionsAll;
        }
    }

    /**
     * 
     * @param type $storeId
     * @return type
     */
    public function getDesignCfgSection($storeId = NULL)
    {
        if ($storeId) {
            return Mage::getStoreConfig('themesetting_design', $storeId);
        } else {
            return Mage::getStoreConfig('themesetting_design');
        }
    }

    /**
     * 
     * @param type $optionString
     * @return type
     */
    public function getCfg($optionString)
    {
        return Mage::getStoreConfig('megamenu/' . $optionString);
    }

    /**
     * 
     * @param type $color
     * @return boolean
     */
    public function isColor($color)
    {
        if ($color && $color != 'transparent') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * @param type $group
     * @param type $storeId
     * @return type
     */
    public function getCfgGroup($group, $storeId = NULL)
    {
        if ($storeId) {
            return Mage::getStoreConfig('themesetting/' . $group, $storeId);
        } else {
            return Mage::getStoreConfig('themesetting/' . $group);
        }
    }

    /**
     * 
     * @param type $active
     * @param type $id
     * @return type
     */
    public function getShowblock($active, $id)
    {
        if ($active == 1) {
            $block = Mage::getModel('cms/block')->load($id);
            return $block->getContent();
        } else {
            return;
        }
    }

    /**
     * 
     * @param type $id
     * @return type
     */
    public function getShowthumbnail($id)
    {
        $thumbnail = $this->Megamenu($id);
        
        return $thumbnail[0]['active_thumbail'];
    }
}
