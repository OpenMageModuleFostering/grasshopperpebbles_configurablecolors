<?php 

class Grasshopperpebbles_Configurablecolors_ConfigurablecolorsController extends Mage_Core_Controller_Front_Action {

		var $_product = '';
		
		
        public function getassociatedproductsAction() {
        	
			$product_id = $this->getRequest()->getParam('product_id');
			$thumb_size = $this->getRequest()->getParam('thumb_size');
			$large_size = $this->getRequest()->getParam('large_size');
			$zoom_size = $this->getRequest()->getParam('zoom_size');
			
			$_product = Mage::getModel('catalog/product')->load($product_id);
    		$_helper = Mage::helper('catalog/output');
   		
			$json_assoc = array();
			if ($_product->getTypeId() == "configurable") {
        		$associated_products = $_product->loadByAttribute('sku', $_product->getSku())->getTypeInstance()->getUsedProducts();
				
        		foreach ($associated_products as $assoc) {
        			$assocProduct =Mage::getModel('catalog/product')->load($assoc->getId());
					$thumbs = array();
					if (count($assocProduct->getMediaGalleryImages()) > 0) {
						foreach ($assocProduct->getMediaGalleryImages() as $_image) {
							$thumbs[] = array(
                                'assoc_id' => ''.$assoc->getId().'',
                                'thumb_label' => ''. $_image->getLabel() .'',
								'thumb_src' => ''. Mage::helper('catalog/image')->init($assocProduct, 'thumbnail', $_image->getFile())->resize($thumb_size).'',
								'large_src' => ''. Mage::helper('catalog/image')->init($assocProduct, 'image', $_image->getFile())->resize($large_size).'',
								'zoom_src' => ''. Mage::helper('catalog/image')->init($assocProduct, 'image', $_image->getFile())->resize($zoom_size).'');
						}
					}
        			
        			$gender = ($assoc->offsetExists('gender')) ? $assoc->getAttributeText("gender") : '';
					$size = $this->getSizeAttribute($assoc);
        			$json_assoc[] = array(
                                'assoc_id' => ''.$assoc->getId().'',
                                'color_name' => ''. $assoc->getAttributeText("color").'',
                                'item_size' => ''. $size .'',
                                'gender' => ''. $gender .'',
                                'color_id' => ''.$assoc->getColor().'',
								'large_src' => ''. ($assoc->image == "no_selection" || $assoc->image == "" ? Mage::helper('catalog/image')->init($_product, 'image', $_product->image)->resize($large_size) : Mage::helper('catalog/image')->init($assoc, 'image', $assoc->image)->resize($large_size)).'',
								'zoom_src' => ''. ($assoc->image == "no_selection" || $assoc->image == "" ? Mage::helper('catalog/image')->init($_product, 'image', $_product->image)->resize($zoom_size) : Mage::helper('catalog/image')->init($assoc, 'image', $assoc->image)->resize($zoom_size)).'',
								'thumbs' => $thumbs);
            	}
		    } 
		    $data = json_encode($json_assoc);
		    $data = '{"hasGender":'. '"'. $gender .'"' . ', "items": '. $data . '}';

            echo $data;
        }
		
		private function getSizeAttribute($assoc) {
			$size = '';
			if ($assoc->offsetExists('shirt_size')) {
				return $assoc->getAttributeText("shirt_size");
			} else if ($assoc->offsetExists('shoe_size')) {
				return $assoc->getAttributeText("shoe_size");
			}
		}
    }
