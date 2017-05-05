<?php

class AV_RequestPrice_Helper_Data extends Mage_Core_Helper_Abstract {

    public function loadFormUrl() {
        $loadformurl = Mage::getUrl('requestprice/form/loadform');
        return $loadformurl;
    }

    public function submitFormUrl() {
        $submitformurl = Mage::getUrl('requestprice/form/submit');
        return $submitformurl;
    }

    public function getButtonTitle() {
        return Mage::getStoreConfig('catalog/request_price/button_text');
    }

    public function showRequestPriceButton() {
        return Mage::getStoreConfig('catalog/request_price/enable');
    }

}
