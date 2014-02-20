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
 * 
 * 
 * @category   ProxiBlue
 * @package    ProxiBlue_NewRelic
 * @author     Lucas van Staden (support@proxiblue.com.au)
 * */
class ProxiBlue_NewRelic_Helper_Data extends Mage_Core_Helper_Abstract {

    /**
     * Test if a message should be ignored
     * 
     * @param string $message
     * @param string $type
     * @return boolean
     */
    public function ignoreMessage($message, $type) {
        try {
            $ignoreList = unserialize(Mage::getStoreConfig('newrelic/settings/'.$type.'_ignore_message'));
            if (is_array($ignoreList) && count($ignoreList) > 0) {
                array_walk($ignoreList, array($this, 'cleanIgnoreList'));
                //$ignoreList = array_filter($ignoreList, 'strlen');
                return $this->ignoreInString($message, $ignoreList); 
            }
        } catch (Exception $e) {
            return true;
        }
        return false; // default - ignore none
    }
    
    /**
     * Reformat the config array
     * 
     * @param array $item
     * @param string $key
     */
    public function cleanIgnoreList(&$item, $key) {
        $item = $item['string'];
    }

    /**
     * Check if any of the strings are in the message
     * 
     * @param string $message
     * @param array $ignores
     * @return bool
     */
    private function ignoreInString($message, $ignores) {
        $regexp = '/(' . implode('|', array_values($ignores)) . ')/i';
        return (bool) preg_match($regexp, $message);
    }
    
    /**
     * Test the given API key is correct 
     * 
     * @param string $apiKey
     * @return boolean
     */
    
    public function testApiKey($apiKey){
        if($apiKey != Mage::getStoreConfig('newrelic/api/api_key')){
            return false;
        }
        return true;
    }
    
    public function customMetric($name,$value){
        
        if (extension_loaded('newrelic')) {
             try {
                if(!is_numeric($value)){
                    throw new Exception('Metric value must be numeric value');
                }
                $this->setAppName();
                return newrelic_custom_metric('Custom/'.$name, $value);
             } catch (Exception $e) {
                 Mage::logException($e);
             }   
        }
        return false;
    }
    
    /**
     * Test if a message should be ignored
     * 
     * @param string $message
     * @param string $type
     * @return boolean
     */
    public function ignoreModule($module) {
        try {
            $ignoreList = unserialize(Mage::getStoreConfig('newrelic/settings/ignore_modules'));
            if (is_array($ignoreList) && count($ignoreList) > 0) {
                array_walk($ignoreList, array($this, 'cleanIgnoreList'));
                //$ignoreList = array_filter($ignoreList, 'strlen');
                return $this->ignoreInString($module, $ignoreList); 
            }
        } catch (Exception $e) {
            return true;
        }
        return false; // default - ignore none
    }
    
    /**
     * Helper function to set the application name used to report
     */
    public function setAppName(){
        if (extension_loaded('newrelic')) {
            $application_name = Mage::getStoreConfig('newrelic/api/application_name');
            $license_key = Mage::getStoreConfig('newrelic/api/license_key');
            return newrelic_set_appname($application_name,$license_key,true);
        }
    }
}