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
            if (Mage::getStoreConfig('newrelic/settings/record_system_log') && mage::helper('newrelic')->ignoreMessage($event['message'], 'system_log')) {
                if ($event['priorityName'] == 'DEBUG' && Mage::getStoreConfig('newrelic/settings/system_log_ignore_debug')) {
                    return;
                }
                Mage::Helper('newrelic')->setAppName();
                newrelic_notice_error($this->_eventType . ': [' . $event['priorityName'] . '] '. $event['message']);
            }
        }
    }

}