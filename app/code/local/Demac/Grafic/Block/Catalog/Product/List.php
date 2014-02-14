<?php
/**
 * Magento Enterprise Edition
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Magento Enterprise Edition License
 * that is bundled with this package in the file LICENSE_EE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.magentocommerce.com/license/enterprise-edition
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_Catalog
 * @copyright   Copyright (c) 2012 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://www.magentocommerce.com/license/enterprise-edition
 */


/**
 * Product list
 *
 * @category   Mage
 * @package    Mage_Catalog
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Demac_Grafic_Block_Catalog_Product_List extends Mage_Catalog_Block_Product_List
{
    /**
     * Need use as _prepareLayout - but problem in declaring collection from
     * another block (was problem with search result)
     */
    protected function _beforeToHtml()
    {
        $toolbar = $this->getToolbarBlock();

        // called prepare sortable parameters
        $collection = $this->_getProductCollection();

        // use sortable parameters
        if ($orders = $this->getAvailableOrders()) {
            $toolbar->setAvailableOrders($orders);
        }
        if ($sort = $this->getSortBy()) {
            $toolbar->setDefaultOrder($sort);
        }
        if ($dir = $this->getDefaultDirection()) {
            $toolbar->setDefaultDirection($dir);
        }
        if ($modes = $this->getModes()) {
            $toolbar->setModes($modes);
        }

        // set collection to toolbar and apply sort
        $toolbar->setCollection($collection);

        // do this only not on first page load
        if (true){
            Mage::log('first: ' . $collection->getSelect()->__toString());
            //$collection->addAttributeToSort('entity_id', 'ASC');
            $collection->addOrder('entity_id', 'ASC');
//            $collection->unshiftOrder('entity_id', 'ASC');
            Mage::log('second: ' . $collection->getSelect()->__toString());
            $collection->load();
            Mage::log('third: ' . $collection->getSelect()->__toString());
            // get the first two products
//            $clone->setCurPage(1)->setPageSize(2);
            $i = 0;
            foreach($collection as $item){
                $collection->addAttributeToFilter('entity_id', array('neq'=>$item->getId()));
                $i++;
                if ($i > 1) break;
            }

//            $limit = 8;
            $collection->clear();

            $collection->load();
        }

        $this->setChild('toolbar', $toolbar);
//        Mage::dispatchEvent('catalog_block_product_list_collection', array(
//            'collection' => $this->_getProductCollection()
//        ));

        $this->_getProductCollection()->load();

//        return parent::_beforeToHtml();
        return $this;
    }
}
