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
 * New Relic General API model
 * 
 * @category   ProxiBlue
 * @package    ProxiBlue_NewRelic
 * @author     Lucas van Staden (support@proxiblue.com.au)
 **/

class ProxiBlue_NewRelic_Model_Api extends ProxiBlue_NewRelic_Model_Abstract {
    
    protected $_eventType = 'Api';
    
    /**
     * Get the application names
     * 
     * @return array
     */
    public function getApplications(){
        $result = $this->talkToNewRelic('applications');
        // parse the xml
        $xmlObj = simplexml_load_string($result);
        $applications = array();
        foreach ($xmlObj->application as $key => $app) {
            $applications[] = (string)$app->name;
        }
        //save the applications to the system for list lookup in admin
        $config = new Mage_Core_Model_Config();
        $config ->saveConfig('newrelic/appnames/lookup/', serialize($applications), 'default', 0);
        return $applications;
        
    }
    
    /**
     * Get the New Relic Account Details
     * @return array
     */
    public function getAccountDetails(){
        $headers = array(
            'x-api-key:' . $this->_api_key
        );
        $http = new Varien_Http_Adapter_Curl();
        
        $http->write('GET', 'https://api.newrelic.com/api/v1/accounts.xml', '1.1', $headers);
        $response = $http->read();
        $response = Zend_Http_Response::extractBody($response);
        // parse the xml
        $xmlObj = simplexml_load_string($response);
        $accountDetails = array('accountid'=>(string)$xmlObj->account->id,
                                'accesskey'=>(string)$xmlObj->account->{"data-access-key"},
                                'licensekey'=>(string)$xmlObj->account->{"license-key"}
                                );
        $config = new Mage_Core_Model_Config();
        $config ->saveConfig('newrelic/api/account_id', $accountDetails['accountid'], 'default', 0);
        $config ->saveConfig('newrelic/api/data_access_key', $accountDetails['accesskey'], 'default', 0);
        $config ->saveConfig('newrelic/api/license_key', $accountDetails['licensekey'], 'default', 0);
        
        return $accountDetails;
        
    }
    
    /**
     * Talk to new relic
     * 
     * @param string $restPoint
     * @return string
     */
    public function talkToNewRelic($restPoint) {
        $headers = array(
            'x-api-key:' . $this->_api_key
        );
        $http = new Varien_Http_Adapter_Curl();
        
        $http->write('GET', 'https://api.newrelic.com/api/v1/accounts/'.$this->_account_Id.'/'.$restPoint.'.xml', '1.1', $headers);
        $response = $http->read();
        $response = Zend_Http_Response::extractBody($response);
        return $response;
    }
    
}