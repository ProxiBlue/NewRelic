<?php

/**
 * Observers for custom metrics
 * 
 * @category   ProxiBlue
 * @package    ProxiBlue_NewRelic
 * @author     Lucas van Staden (support@proxiblue.com.au)
 **/

class ProxiBlue_NewRelic_Model_Metrics {
    
    /**
     * Hook to record customer account create metrics
     * @param Varien_Event_Observer $observer 
     */

    public function customer_register_success(Varien_Event_Observer $observer) {
        if (Mage::getStoreConfig('newrelic/metrics/signup_success')) {
            Mage::helper('newrelic')->customMetric('Registration/Success',1);
            return $this;
        }
    }
}
