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
 * */
class ProxiBlue_NewRelic_Model_Log_System extends ProxiBlue_NewRelic_Model_Abstract {

    protected $_eventType = 'System Log Entry';

    /**
     * Record a log event to new relic
     * 
     * @param type $event
     * @return type
     */
    public function recordEvent($event) {
        if (extension_loaded('newrelic')) {
            if (Mage::getStoreConfig('newrelic/settings/record_system_log') && !Mage::helper('newrelic')->ignoreMessage($event['message'], 'system_log')) {
                if ($event['priorityName'] == 'DEBUG' && Mage::getStoreConfig('newrelic/settings/system_log_ignore_debug')) {
                    return;
                }
                Mage::Helper('newrelic')->setAppName();
                newrelic_notice_error($this->_eventType . ': [' . $event['priorityName'] . '] '. $event['message']);
            }
        }
    }

}