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

/**
 * Base functions to communicate with new relic
 * 
 * @category   ProxiBlue
 * @package    ProxiBlue_NewRelic
 * @author     Lucas van Staden (support@proxiblue.com.au)
 * */
class ProxiBlue_NewRelic_Model_Abstract {

    protected $_eventType = 'Unknown';
    protected $_headers;
    protected $_account_Id;
    protected $_api_key;
    protected $_data_key;
    
    public function __construct(){
        try {
            $this->_account_Id = Mage::getStoreConfig('newrelic/api/account_id');
            $this->_api_key = Mage::getStoreConfig('newrelic/api/api_key');
            $this->_data_key = Mage::getStoreConfig('newrelic/api/data_access_key');
        } catch (Exception $e) {
            throw new ProxiBlue_NewRelic_Exception($e->getMessage(),$e->getCode(), $e);
        }    
    }
    
            
    /**
     * Record index events via curl
     * @param string $type
     * @return \ProxiBlue_NewRelic_Model_Observer 
     */        
    public function recordEvent($message) {
        $type = $this->_eventType . ": " . $message;
        $application_name = Mage::getStoreConfig('newrelic/api/application_name');
        $user = $this->getCurrentUser();
        $data = "deployment[app_name]={$application_name}&";
        $data .= "deployment[description]={$type}&";
        $data .= "deployment[revision]={$type}&";
        $data .= "deployment[user]={$user}";
        try {
             $response = $this->talkToNewRelic($data);
            if (Mage::app()->getStore()->isAdmin() && !empty($response)) {
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__("Event recorded in NewRelic : " . $type));
            }
        } catch (Exception $e) {
            throw ProxiBlue_NewRelic_Exception($e);
        }
        return $this;
    }

    /**
     * Get the current user, be it admin or frontend
     */
    public function getCurrentUser() {
        if (Mage::app()->getStore()->isAdmin()) {
            if(is_object(Mage::getSingleton('admin/session')->getUser())){
                return Mage::getSingleton('admin/session')->getUser()->getEmail();
            } else {
                return 'Shell Script';
            }
        } else if (Mage::getSingleton('customer/session')->isLoggedIn()) {
            return Mage::getSingleton('customer/session')->getCustomer()->getId() . ' / ' . Mage::getSingleton('customer/session')->getCustomer()->getEmail();
        } else {
            return 'Guest User - not Logged in';
        }
    }
    
    /**
     * Talk to NewRelic API
     * 
     * @param array $data
     * @return string
     */

    public function talkToNewRelic($data) {
        $headers = array(
            'x-api-key:' . $this->_api_key
        );
        $http = new Varien_Http_Adapter_Curl();
        $http->write('POST', 'https://rpm.newrelic.com/deployments.xml', '1.1', $headers, $data);
        $response = $http->read();
        $response = Zend_Http_Response::extractBody($response);
        return $response;
    }

}