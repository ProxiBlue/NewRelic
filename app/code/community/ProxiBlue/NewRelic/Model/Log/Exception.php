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
        if(Mage::getStoreConfig('newrelic/settings/record_exception') && !Mage::helper('newrelic')->ignoreMessage($e->getMessage(), 'exception')){
                self::pushEvent($e); 
        }    
    }
    
    /**
     * Static since a store config exception (caused by a module config error) cannot call magento's model objects.
     * If a store config exception occurs, the exception class logs it drect.
     * 
     * @param type $e
     */
    static public function pushEvent($e){
        if (extension_loaded('newrelic')) {
            $message = $e->getMessage();
            $message = (empty($message))?get_class($e):$message;
            Mage::Helper('newrelic')->setAppName();
            newrelic_notice_error ($message, $e);
        }    
    }
    
}
