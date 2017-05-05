<?php

class AV_RequestPrice_Block_Adminhtml_Request_Edit_Form extends Mage_Adminhtml_Block_Widget_Form {

    protected function _prepareForm() {
        if (Mage::registry('request_data')) {
            $data = Mage::registry('request_data')->getData();
        } else {
            $data = array();
        }

        $form = new Varien_Data_Form(array(
            "id"      => "edit_form",
            "action"  => $this->getUrl("*/*/save", array("id" => $this->getRequest()->getParam("id"))),
            "method"  => "post",
            "enctype" => "multipart/form-data",
                )
        );
        $form->setUseContainer(true);
        $this->setForm($form);

        $fieldset = $form->addFieldset('request_data', array(
            'legend' => Mage::helper('avrequestprice')->__('Request Price Information')
        ));

        $fieldset->addField('customer_name', 'text', array(
            'label'    => Mage::helper('avrequestprice')->__('Name'),
            'class'    => '',
            'required' => false,
            'name'     => 'customer_name',
            'note'     => Mage::helper('avrequestprice')->__('Customer name.'),
        ));

        $fieldset->addField('customer_email', 'text', array(
            'label'    => Mage::helper('avrequestprice')->__('Email'),
            'class'    => '',
            'required' => false,
            'name'     => 'customer_email',
            'note'     => Mage::helper('avrequestprice')->__('Customer email.'),
        ));

        $fieldset->addField('product_sku', 'text', array(
            'label'    => Mage::helper('avrequestprice')->__('Product SKU'),
            'class'    => '',
            'required' => false,
            'name'     => 'product_sku',
        ));

        $fieldset->addField('comment', 'textarea', array(
            'label'    => Mage::helper('avrequestprice')->__('Comment'),
            'class'    => '',
            'required' => false,
            'name'     => 'comment',
        ));

        $fieldset->addField('status', 'select', array(
            'label'  => Mage::helper('avrequestprice')->__('Status'),
            'name'   => 'status',
            'values' => array(
                array(
                    'value' => 0,
                    'label' => Mage::helper('avrequestprice')->__('New'),
                ),
                array(
                    'value' => 1,
                    'label' => Mage::helper('avrequestprice')->__('In Progress'),
                ),
                array(
                    'value' => 2,
                    'label' => Mage::helper('avrequestprice')->__('Closed'),
                ),
            ),
        ));

        $form->setValues($data);

        return parent::_prepareForm();
    }

}
