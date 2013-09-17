<?php

class ProxiBlue_NewRelic_ApiController extends Mage_Core_Controller_Front_Action {

    
    public function namesAction() {
        if(Mage::helper('newrelic')->testApiKey($this->getRequest()->getParam('key'))) {
            $newRelicApi = Mage::getModel('newrelic/api');
            $applications = $newRelicApi->getApplications();
            $this->getResponse()->setHeader('Content-type', 'application/json');
            $this->getResponse()->setBody(json_encode(array('result'=>$applications)));
        }  else {
            $this->getResponse()->setHeader('Content-type', 'application/json');
            $this->getResponse()->setBody(json_encode(array('error'=>'Invalid API key given')));
        }  
        return $this;
    }
    
    public function accountDetailsAction() {
        if(Mage::helper('newrelic')->testApiKey($this->getRequest()->getParam('key'))) {
            $newRelicApi = Mage::getModel('newrelic/api');
            $accountDetails = $newRelicApi->getAccountDetails();
            $this->getResponse()->setHeader('Content-type', 'application/json');
            $this->getResponse()->setBody(json_encode($accountDetails));
        } else {
            $this->getResponse()->setHeader('Content-type', 'application/json');
            $this->getResponse()->setBody(json_encode(array('error'=>'Invalid API key given')));
        }    
        return $this;
        
    }

}
