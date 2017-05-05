<?php

class AV_RequestPrice_Block_Adminhtml_Request_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs {

    public function __construct() {
        parent::__construct();
        $this->setId("request_tabs");
        $this->setDestElementId("edit_form");
        $this->setTitle(Mage::helper("avrequestprice")->__("Request"));
    }

    protected function _beforeToHtml() {
        $this->addTab("form_section", array(
            "label"   => Mage::helper("avrequestprice")->__("Information"),
            "title"   => Mage::helper("avrequestprice")->__("Information"),
            "content" => $this->getLayout()->createBlock("avrequestprice/adminhtml_request_edit_tab_form")->toHtml(),
        ));
        return parent::_beforeToHtml();
    }

}
