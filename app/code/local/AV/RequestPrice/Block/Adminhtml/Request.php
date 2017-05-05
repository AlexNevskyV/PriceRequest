<?php

class AV_RequestPrice_Block_Adminhtml_Request extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct() {
        $this->_controller = "adminhtml_request";
        $this->_blockGroup = "avrequestprice";
        $this->_headerText = $this->__("Price Requests");
        parent::__construct();
        //$this->_removeButton("add", "label", $this->__("Delete Item"));
    }

}
