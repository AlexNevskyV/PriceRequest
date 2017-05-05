<?php

class AV_RequestPrice_Model_Observer {

    public function checkToHidePrice(Varien_Event_Observer $observer) {
        $hidePrice = Mage::helper("avrequestprice")->showRequestPriceButton();

        $block = $observer->getBlock();

        if (get_class($block) == 'Mage_Catalog_Block_Product_View') {
            if ($hidePrice == 1) {
                $block->getProduct()->setCanShowPrice(false);
            }
        }
    }

}
