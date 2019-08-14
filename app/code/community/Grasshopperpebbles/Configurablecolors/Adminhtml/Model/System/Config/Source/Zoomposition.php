<?php
class Grasshopperpebbles_Configurablecolors_Adminhtml_Model_System_Config_Source_Zoomposition
{
    public function toOptionArray()
    {
        return array(
            array('value'=>'inside', 'label'=>Mage::helper('adminhtml')->__('Inside')),
            array('value'=>'left', 'label'=>Mage::helper('adminhtml')->__('Left')),
            array('value'=>'right', 'label'=>Mage::helper('adminhtml')->__('Right')),                       
        );
    }

}