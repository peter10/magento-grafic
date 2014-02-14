<?php

class Demac_Grafic_Block_Select extends Varien_Data_Form_Element_Select
{


    public function getElementHtml()
    {
        $html = '<div class="select-wrapper">';
        $html .= parent::getElementHtml();
        $html .= '</div>';
        return $html;
    }
}