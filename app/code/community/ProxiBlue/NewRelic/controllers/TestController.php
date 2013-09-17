<?php

class ProxiBlue_NewRelic_TestController extends Mage_Core_Controller_Front_Action {

    public function systemLogAction() {
        if (Mage::helper('newrelic')->testApiKey($this->getRequest()->getParam('key'))) {
            Mage::log('This is a newrelic test system log entry');
            die('Test log Entry done. Wait a moment and check newrelic errors.');
        } else {
            $this->getResponse()->setHeader('Content-type', 'application/json');
            $this->getResponse()->setBody(json_encode(array('error' => 'Invalid API key given')));
        }
    }

    public function exceptionLogAction() {
        if (Mage::helper('newrelic')->testApiKey($this->getRequest()->getParam('key'))) {
            try {
                Mage::throwException('Test exception thrown');
            } catch (Exception $e) {
                Mage::logException($e);
            }
            die('Test Exception thrown. Wait a moment and check newrelic errors.');
        } else {
            $this->getResponse()->setHeader('Content-type', 'application/json');
            $this->getResponse()->setBody(json_encode(array('error' => 'Invalid API key given')));
        }
    }

}
