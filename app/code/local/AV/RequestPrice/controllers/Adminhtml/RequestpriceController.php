<?php

class AV_RequestPrice_Adminhtml_RequestpriceController extends Mage_Adminhtml_Controller_Action {

    protected function _initAction() {
        $this->loadLayout()->_setActiveMenu("avrequestprice/requestprice")->_addBreadcrumb(Mage::helper("adminhtml")->__("Price Requests"), Mage::helper("adminhtml")->__("Price Requests"));
        return $this;
    }

    public function indexAction() {
        $this->_title($this->__("Price Requests"));

        $this->_initAction();
        $this->renderLayout();
    }

    public function editAction() {
        $this->_title($this->__("Price Requests"));

        $id    = $this->getRequest()->getParam("id");
        $model = Mage::getModel("avrequestprice/request")->load($id);
        if ($model->getId()) {
            Mage::register("request_data", $model);
            $this->loadLayout();
            $this->_setActiveMenu("avrequestprice/requestprice");
            $this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()->createBlock("avrequestprice/adminhtml_request_edit"))->_addLeft($this->getLayout()->createBlock("avrequestprice/adminhtml_request_edit_tabs"));
            $this->renderLayout();
        } else {
            Mage::getSingleton("adminhtml/session")->addError(Mage::helper("avrequestprice")->__("Item does not exist."));
            $this->_redirect("*/*/");
        }
    }

    public function newAction() {
        $this->_title($this->__("New Item"));

        $id    = $this->getRequest()->getParam("id");
        $model = Mage::getModel("avrequestprice/request")->load($id);

        $data = Mage::getSingleton("adminhtml/session")->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        Mage::register("request_data", $model);

        $this->loadLayout();
        $this->_setActiveMenu("avrequestprice/requestprice");

        $this->getLayout()->getBlock("head")->setCanLoadExtJs(true);


        $this->_addContent($this->getLayout()->createBlock("avrequestprice/adminhtml_request_edit"))->_addLeft($this->getLayout()->createBlock("avrequestprice/adminhtml_request_edit_tabs"));

        $this->renderLayout();
    }

    public function saveAction() {
        $post_data = $this->getRequest()->getPost();
        if ($post_data) {
            try {

                $requestModel = Mage::getModel("avrequestprice/request")
                        ->addData($post_data)
                        ->setId($this->getRequest()->getParam("id"));

                $requestModel->save();

                Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Request was successfully saved"));
                Mage::getSingleton("adminhtml/session")->setRequestData(false);
                if ($this->getRequest()->getParam("back")) {
                    $this->_redirect("*/*/edit", array("id" => $requestModel->getId()));
                    return;
                }
                $this->_redirect("*/*/");
                return;
            } catch (Exception $e) {
                Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
                Mage::getSingleton("adminhtml/session")->setRequestData($this->getRequest()->getPost());
                $this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
                return;
            }
        }
        $this->_redirect("*/*/");
    }

}
