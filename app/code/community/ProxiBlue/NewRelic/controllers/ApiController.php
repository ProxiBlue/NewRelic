<?php       
  /**
  *    This file is part of ProxiBlue NewRelic Module  available via GitHub https://github.com/ProxiBlue/NewRelic     
  *
  *    ProxiBlue NewRelic Module is free software: you can redistribute it and/or modify
  *    it under the terms of the GNU General Public License as published by
  *    the Free Software Foundation, either version 3 of the License, or
  *    (at your option) any later version.
  *
  *    ProxiBlue NewRelic Module is distributed in the hope that it will be useful,
  *    but WITHOUT ANY WARRANTY; without even the implied warranty of
  *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  *    GNU General Public License for more details.
  *
  *    You should have received a copy of the GNU General Public License
  *    along with ProxiBlue NewRelic Module.  
  *    If not, see <http://www.gnu.org/licenses/>.
  **/
?>
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