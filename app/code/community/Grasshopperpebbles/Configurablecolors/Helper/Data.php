<?php
class Grasshopperpebbles_Configurablecolors_Helper_Data extends Mage_Core_Helper_Abstract {
	
	protected function _getConnection($type = 'core_read'){
    	return Mage::getSingleton('core/resource')->getConnection($type);
	}
	
	protected function _getTableName($tableName){
	    return Mage::getSingleton('core/resource')->getTableName($tableName);
	}
	
	public function _getAttributeId($attribute_code = 'price', $entity_type_id){
	    $connection = $this->_getConnection('core_read');
	    $sql = "SELECT attribute_id FROM " . $this->_getTableName('eav_attribute') . " WHERE entity_type_id = ? AND attribute_code = ?";
	    return $connection->fetchOne($sql, array($entity_type_id, $attribute_code));
	}
	
	public function _getEntityTypeId($entity_type_code = 'catalog_product'){
	    $connection = $this->_getConnection('core_read');
	    $sql        = "SELECT entity_type_id FROM " . $this->_getTableName('eav_entity_type') . " WHERE entity_type_code = ?";
	    return $connection->fetchOne($sql, array($entity_type_code));
	}
}