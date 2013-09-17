<?php


/**
 * Admin DashBoard Graphs
 * 
 * @category   ProxiBlue
 * @package    ProxiBlue_NewRelic
 * @author     Lucas van Staden (support@proxiblue.com.au)
 **/


class ProxiBlue_NewRelic_Block_Adminhtml_Dashboard_Diagrams extends Mage_Adminhtml_Block_Dashboard_Diagrams
{
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if (Mage::getStoreConfig('newrelic/embeded/enabled')) {
            $this->addTab('newrelic', array(
                'label'     => $this->__('NewRelic'),
                'content'   => $this->getLayout()->createBlock('newrelic/adminhtml_dashboard_tab_newrelic')->toHtml(),
            ));
        }
        return $this;
        
    }
}
