<?php

/**
 * LOgs logging model
 * 
 * @category   ProxiBlue
 * @package    ProxiBlue_NewRelic
 * @author     Lucas van Staden (support@proxiblue.com.au)
 **/

class ProxiBlue_NewRelic_Model_Logs extends ProxiBlue_NewRelic_Model_Abstract {
    
    protected $_eventType = 'System Log Entry';
    
    public function recordEvent($event) {
        if (extension_loaded('newrelic')) {
           newrelic_notice_error ($this->_eventType . ": " . $event['message']); 
        }
    }
    
    public function setEventType($type){
        $this->_eventType = $type;
    }
}

?>
