<?php

/**
 * Intercept logs to new relic
 * 
 * @category   ProxiBlue
 * @package    ProxiBlue_NewRelic
 * @author     Lucas van Staden (support@proxiblue.com.au)
 **/

class ProxiBlue_Newrelic_Model_Log_Writer_Stream extends Zend_Log_Writer_Stream {

    /**
     * Write a message to the log.
     *
     * @param  array  $event  event data
     * @return void
     */
    protected function _write($event) {
        parent::_write($event);
        // Log to NewRelic
        self::_log_to_newrelic($event);
    }

    /**
     * Record the event in New Relic
     *
     * @param  array  $event  event data
     * @return void
     */
    public static function _log_to_newrelic($event) {
        // Log the event to New Relic
        try {
            if (array_key_exists('priorityName', $event) && $event['priorityName'] != 'ERR') {
                $newRelic = Mage::getModel('newrelic/log_system');
                $newRelic->recordEvent($event);
            } 
        } catch (Exception $e) {
            // cannot log it else we end up in a loop.
        }    
    }   
}
