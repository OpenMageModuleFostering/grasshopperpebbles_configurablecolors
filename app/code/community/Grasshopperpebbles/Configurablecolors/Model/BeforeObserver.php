<?php
/**
 * GrasshopperPebbles extension 
 *
 * NOTICE OF LICENSE 
 *
 * This source file is subject to the License
 * that is bundled with this package in the file GP-LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://grasshopperpebbles.com/gp-license.txt
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to support@grasshopperpebbles.com so we can send you a copy immediately.
 * 
 * @category    Grasshopperpebbles
 * @package     Grasshopperpebbles_Configurablecolors
 * @license     http://grasshopperpebbles.com/gp-license.txt, http://devoutgeek.com/gp-license.txt
 * @copyright   Copyright (c) 2014 Grasshopperpebbles, LLC. (http://grasshopperpebbles.com)
 * @author      Les Green <support@grasshopperpebbles.com>
 */
class Grasshopperpebbles_Configurablecolors_Model_BeforeObserver
{
    public function setMediaTemplate($observer)
    {
		$_block = $observer->getEvent()->getBlock();
		$controller = $observer->getAction();
		if ($controller->getFullActionName() == 'catalog_product_view') {
			$product = Mage::registry('current_product');
			if ($product->getTypeId() == "configurable") {
				$layout = $controller->getLayout();
				$infoBlock = $layout->getBlock('product.info.media');
            	/*set our template*/
            	$infoBlock->setTemplate('configurablecolors/catalog/product/view/media.phtml');
			}
		}	
    }
}