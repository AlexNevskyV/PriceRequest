<?php

class AV_RequestPrice_Block_Adminhtml_Request_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {

    public function __construct() {

        parent::__construct();
        $this->_objectId   = "id";
        $this->_blockGroup = "avrequestprice";
        $this->_controller = "adminhtml_request";
        $this->_updateButton("save", "label", Mage::helper("avrequestprice")->__("Save Item"));
        $this->_removeButton("delete", "label", Mage::helper("avrequestprice")->__("Delete Item"));
        $this->_removeButton("reset", "label", Mage::helper("avrequestprice")->__("Reset Item"));

        $this->_addButton("saveandcontinue", array(
            "label"   => Mage::helper("avrequestprice")->__("Save And Continue Edit"),
            "onclick" => "saveAndContinueEdit()",
            "class"   => "save",
                ), -100);



        $this->_formScripts[] = "function saveAndContinueEdit(){editForm.submit($('edit_form').action+'back/edit/');}";
    }

    public function getHeaderText() {
        if (Mage::registry("request_data") && Mage::registry("request_data")->getId()) {

            $header = Mage::helper("avrequestprice")->__("Edit request from %s, ", $this->htmlEscape(Mage::registry("request_data")->getCustomerName()));
            $header .= Mage::helper("avrequestprice")->__("created at %s", $this->htmlEscape(Mage::registry("request_data")->getCreatedAt()));
            return $header;
        } else {
            return Mage::helper("avrequestprice")->__("Add Request");
        }
    }

}
