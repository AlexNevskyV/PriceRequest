<?php

class AV_RequestPrice_FormController extends Mage_Core_Controller_Front_Action {

    public function loadformAction() {
        /* $this->loadLayout();
          $this->renderLayout(); */
        $params       = $this->getRequest()->getPost();
        $success      = true;
        $request_form = $this->getLayout()->createBlock('avrequestprice/form', 'requestprice.form')->setTemplate('av/requestprice/form.phtml')->toHtml();
        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode(array('success' => $success, 'request_form' => $request_form)));
    }

    public function submitAction() {
        if ($this->getRequest()->getPost()) {
            $reqprice = Mage::getModel('avrequestprice/request');
            $params   = $this->getRequest()->getPost();

            foreach ($params as $pkey => $pdata) {
                $params[$pkey] = trim($pdata);
            }

            if ((int) $params['product_id'] > 0) {
                $product = Mage::getModel('catalog/product')->load($params['product_id']);
                $reqprice->setProductSku($product->getSku())
                ->setProductName($product->getName());
            }

            $reqprice->setCustomerName($params['name'])
                    ->setCustomerEmail($params['email'])
                    ->setStatus(0)
                    ->setProductId($params['product_id'])
                    ->setCreatedAt(now())
                    ->setComment($params['comment'])
            ;
            if ($params['customer_id'] > 0) {
                $reqprice->setCustomerId($params['customer_id']);
            }

            try {
                $reqprice->save();

                $success = true;
                $message = $this->__('Thank you! Your request has been sent.');
            } catch (Exception $e) {
                $success = false;
                $message = $this->__('Sorry, but your request is Not Sent. Please try agaion later.');
            }

            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode(array('success' => $success, 'message' => $message,)));
        }
    }

}
