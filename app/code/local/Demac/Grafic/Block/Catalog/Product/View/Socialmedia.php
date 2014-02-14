<?php

class Demac_Grafic_Block_Catalog_Product_View_Socialmedia extends Mage_Core_Block_Template
{
    public function getProduct()
    {
        return Mage::registry('current_product');
    }

    public function getCanonicalUrl()
    {
        return $this->getProduct()->getProductUrl();
    }

    public function getProductImageUrl()
    {
        return $this->helper('catalog/image')->init($this->getProduct(), 'small_image')->resize(100,100);
    }

    public function getProductDescription()
    {
        return $this->getProduct()->getName();
    }

    public function getSiteName()
    {
        return Mage::app()->getStore()->getName();
    }
}
