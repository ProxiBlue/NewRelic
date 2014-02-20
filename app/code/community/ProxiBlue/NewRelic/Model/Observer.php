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
 * Observers for cache and index events
 * 
 * @category   ProxiBlue
 * @package    ProxiBlue_NewRelic
 * @author     Lucas van Staden (support@proxiblue.com.au)
 **/

class ProxiBlue_NewRelic_Model_Observer {
    
    /**
     * Hook to record cache events
     * @param Varien_Event_Observer $observer 
     */

    public function adminhtml_cache_refresh_type(Varien_Event_Observer $observer) {
        if (Mage::getStoreConfig('newrelic/settings/record_cache')) {
            $event = $observer->getEvent();
            $newRelic = Mage::getModel('newrelic/cache');
            $newRelic->recordEvent($event->getType());
            return $this;
        }
    }
    
    /**
     * Hook to record cache full flush
     * @param Varien_Event_Observer $observer 
     */

    public function adminhtml_cache_flush_all(Varien_Event_Observer $observer) {
        if (Mage::getStoreConfig('newrelic/settings/record_cache')) {
            $event = $observer->getEvent();
            $newRelic = Mage::getModel('newrelic/cache');
            $newRelic->recordEvent('Storage');
            return $this;
        }
    }
    
    /**
     * Hook to record cache storage
     * @param Varien_Event_Observer $observer 
     */

    public function adminhtml_cache_flush_system(Varien_Event_Observer $observer) {
        if (Mage::getStoreConfig('newrelic/settings/record_cache')) {
            $newRelic = Mage::getModel('newrelic/cache');
            $newRelic->recordEvent('Full Flush');
            return $this;
        }
    }
    
    /**
     * Hook to record cache storage
     * @param Varien_Event_Observer $observer 
     */

    public function clean_media_cache_after(Varien_Event_Observer $observer) {
        if (Mage::getStoreConfig('newrelic/settings/record_cache')) {
            $newRelic = Mage::getModel('newrelic/cache');
            $newRelic->recordEvent('CSS/JS');
            return $this;
        }
    }
    
    
    /**
     * Hook to record cache storage
     * @param Varien_Event_Observer $observer 
     */

    public function clean_catalog_images_cache_after(Varien_Event_Observer $observer) {
        if (Mage::getStoreConfig('newrelic/settings/record_cache')) {
            $newRelic = Mage::getModel('newrelic/cache');
            $newRelic->recordEvent('media');
            return $this;
        }
    }
    
    

    /**
     * Hook to record index events
     * @param Varien_Event_Observer $observer
     * @return \ProxiBlue_NewRelic_Model_Observer 
     */
    public function controller_action_postdispatch_adminhtml_process_massReindex(Varien_Event_Observer $observer) {
        if (Mage::getStoreConfig('newrelic/settings/record_index')) {
            $vProcessIds = Mage::app()->getRequest()->getParam('process');
            $aProcessIds = (array) $vProcessIds;
            if (empty($aProcessIds) || !is_array($aProcessIds)) {
                return $this;
            } else {
                $newRelic = Mage::getModel('newrelic/index');
                try {
                    $indexer = Mage::getSingleton('index/indexer');
                    foreach ($aProcessIds as $processId) {
                        /* @var $process Mage_Index_Model_Process */
                         $process = $indexer->getProcessById($processId);
                         $newRelic->recordEvent($process->getIndexerCode());
                    }
                } catch (Exception $e) {
                    Mage::logException($e);
                    return $this;
                }
            }
        }
    }

    /**
     * Hook to record index events
     * @param Varien_Event_Observer $observer 
     */
    public function controller_action_postdispatch_adminhtml_process_reindexProcess(Varien_Event_Observer $observer) {
        $this->controller_action_postdispatch_adminhtml_process_massReindex($observer);
    }

}