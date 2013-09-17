<?php

/**
 * Admin DashBoard Graphs
 * 
 * @category   ProxiBlue
 * @package    ProxiBlue_NewRelic
 * @author     Lucas van Staden (support@proxiblue.com.au)
 **/

class ProxiBlue_NewRelic_Block_Adminhtml_Dashboard_Tab_Newrelic extends Mage_Adminhtml_Block_Dashboard_Abstract
{     
    /**
     * Initialize object
     *
     * @return void
     */
    public function __construct()
    {
        $this->setHtmlId('newrelic');
        parent::__construct();
        $this->setTemplate('dashboard/newrelic.phtml');
    }

    public function getEmbededGraphs(){
        $embeddedGraphs = unserialize(Mage::getStoreConfig('newrelic/embeded/graph'));
        if (!is_array($embeddedGraphs)) {
            $embeddedGraphs = array();
        }
        return $embeddedGraphs;
    }
}
