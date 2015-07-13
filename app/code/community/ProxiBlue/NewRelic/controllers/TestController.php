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

class ProxiBlue_NewRelic_TestController extends Mage_Core_Controller_Front_Action {

    public function systemLogAction() {
        if (Mage::helper('proxiblue_newrelic')->testApiKey($this->getRequest()->getParam('key'))) {
            Mage::log('This is a newrelic test system log entry');
            die('Test log Entry done. Wait a moment and check newrelic errors.');
        } else {
            $this->getResponse()->setHeader('Content-type', 'application/json');
            $this->getResponse()->setBody(json_encode(array('error' => 'Invalid API key given')));
        }
    }

    public function exceptionLogAction() {
        if (Mage::helper('proxiblue_newrelic')->testApiKey($this->getRequest()->getParam('key'))) {
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
    
    public function exceptionAction(){
        $this->_forward('exceptionLog');
    }

}