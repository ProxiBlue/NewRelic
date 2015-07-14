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
 * LOgs logging model
 * 
 * @category   ProxiBlue
 * @package    ProxiBlue_NewRelic
 * @author     Lucas van Staden (support@proxiblue.com.au)
 **/

class ProxiBlue_NewRelic_Model_Log_Exception extends ProxiBlue_NewRelic_Model_Abstract {
    
    protected $_eventType = 'Exception';
    
    /**
     * Record an exception event
     * 
     * @param Object $e
     */
    public function recordEvent($e) {
        if(Mage::getStoreConfig('newrelic/settings/record_exception') && !Mage::helper('proxiblue_newrelic')->ignoreMessage($e->getMessage(), 'exception')){
                self::pushEvent($e); 
        }    
    }
    
    /**
     * Static since a store config exception (caused by a module config error) cannot call magento's model objects.
     * If a store config exception occurs, the exception class logs it drect.
     * 
     * @param type $e
     */
    static public function pushEvent($e,$setAppName=true){
        if (extension_loaded('newrelic')) {
            $message = $e->getMessage();
            $message = (empty($message))?get_class($e):$message;
            if($setAppName) {
                Mage::helper('proxiblue_newrelic')->setAppName();
            }    
            newrelic_notice_error ($message, $e);
        }    
    }
    
}