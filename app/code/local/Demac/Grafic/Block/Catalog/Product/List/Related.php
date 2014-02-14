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
 * @category    Enterprise
 * @package     Enterprise_TargetRule
 * @copyright   Copyright (c) 2012 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://www.magentocommerce.com/license/enterprise-edition
 */


/**
 * TargetRule Catalog Product List Related Block
 *
 * @category   Enterprise
 * @package    Enterprise_TargetRule
 */
class Demac_Grafic_Block_Catalog_Product_List_Related
    extends Enterprise_TargetRule_Block_Catalog_Product_List_Related
{

    public function setupForm($_product)
    {
        $form = new Varien_Data_Form(
            array(
                'id'    => 'product_addtocart_form-'.$_product->getId(),
                'method'    => 'post',
                'action'    => $this->getSubmitUrl($_product),
                'class'     => 'related-product',
                //'onsubmit'  => 'Demac.relatedProductSubmit()',
                'html_id_prefix'    => 'product-'.$_product->getId().'_',
                'use_container'     => true,
            )
        );

        $h = new Varien_Data_Form_Element_Hidden(array('name' => 'product', 'value' => $_product->getId()));
        $h->setId('product');
        $form->addElement($h);

        $type = $_product->getTypeInstance(true);
        foreach ($type->getConfigurableAttributesAsArray($_product) as $attribute){
            $options = array(-1 => 'select ' . $attribute['label']); // instead of a label
            foreach($attribute['values'] as $value){
                $options[$value['value_index']] = $value['label'];
            }
            $name = 'super_attribute[' . $attribute['attribute_id'] . ']';
            $select = new Demac_Grafic_Block_Select(array('options' => $options, 'name' => $name));
            $select->setId($name);
            $form->addElement($select);
        }

        $s = new Varien_Data_Form_Element_Submit(array('value' => $this->__('Add to Cart')));
        $s->setId('submit');
        $form->addElement($s);

        return $form;
    }

}
