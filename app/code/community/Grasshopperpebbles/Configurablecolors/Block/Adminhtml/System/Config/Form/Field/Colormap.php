<?php
class Grasshopperpebbles_Configurablecolors_Block_Adminhtml_System_Config_Form_Field_Colormap extends Mage_Adminhtml_Block_System_Config_Form_Field
{
	/**
    * Returns html part of the setting
    *
    * @param Varien_Data_Form_Element_Abstract $element
    * @return string
    */
   protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
   {
       $this->setElement($element);
 
       $html = '<div id="configurable-colors-select-cntnr">';
	   $html .= $this->_getColorOptionsTemplateHtml();
	   $html .= '</div>';
       //$html .= $this->_getRowTemplateHtml();
	   $html .= $this->_getConfigurableTableHtml();
	   
       return $html;
   }
   
   protected function _getColorOptionsTemplateHtml()
   {
   		$html = '<table>';
		$html .= '<tr>';
		$html .= '<td><label for="configurable-color-option">Color</label></td>';
		$html .= '<td><label for="configurable-color-type">Color Type</label></td>';
		$html .= '<td><label for="configurable-color-option">Color Value</label></td>';
		$html .= '<td></td>';
   		$html .= '</tr>';
		$html .= '<tr>';
		$html .= '<td>';
   		$html .= '<select name="configurable-color-option" id="configurable-color-option">';
   		$colors = Mage::getSingleton('eav/config')->getAttribute('catalog_product', 'color')->getSource()->getAllOptions();
		foreach ($colors as $color) {
			$html .= '<option value="'. $color['label'].'">'.$color['label'].'</option>';
		}
		$html .= '</select>';
		$html .= '</td>';
		$html .= '<td>';
		$html .= '<select name="configurable-color-type" id="configurable-color-type">';
		$html .= '<option value="color_hex">Color Hex</option>';
		$html .= '<option value="color_class">Color Class</option>';
		$html .= '<option value="color_image">Color Image</option>';
		$html .= '</select>';
		$html .= '</td>';
		$html .= '<td>';
		$html .= '<input type="text" name="configurable-color-value" id="configurable-color-value" />';
		$html .= '</td>';
		$html .= '<td>';
		$html .= '<button id="configurable-color-add">Add Map</button>';
		$html .= '</td>';
		$html .= '</tr>';
		$html .= '</table>';
		return $html;
   }
	
	protected function _getConfigurableTableHtml() {
		$html = '<table id="configurable-color-table">';
		$html .= '<thead><tr><th>Color Name</th><th>Color Type</th><th>Color Value</th><th>Action</th></tr></thead>';
		$html .= '<tbody></tbody>';
		$html .= '</table>';
		return $html;
	}

}
	