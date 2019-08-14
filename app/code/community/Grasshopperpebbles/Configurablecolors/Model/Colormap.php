<?php
class Grasshopperpebbles_Configurablecolors_Model_Colormap
{
    public function toOptionArray()
    {
        return array(
            array('value'=>1, 'label'=>Mage::helper('configurablecolors')->__('Color Hex')),
            array('value'=>2, 'label'=>Mage::helper('configurablecolors')->__('Color Class')),
            array('value'=>3, 'label'=>Mage::helper('configurablecolors')->__('Color Image')),                       
        );
    }

}