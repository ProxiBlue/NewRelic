<?php

/**
 * Options for admin select for AppNAmes
 * 
 * @category   ProxiBlue
 * @package    ProxiBlue_NewRelic
 * @author     Lucas van Staden (support@proxiblue.com.au)
 **/

class ProxiBlue_NewRelic_Model_Adminhtml_System_Config_Source_Select_Appnames
{

    /**
     * Holds app names
     * @var array 
     */
    protected $_appnames = array();
    
    /**
     * Constructor
     */
    public function __construct() {
        $appnames = Mage::getStoreConfig('newrelic/appnames/lookup');
        if(!is_string($appnames)){
            $appnames = '';
        }
        $this->_appnames = unserialize($appnames);
    }
    
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        $optionArray = array();
        try {
            foreach ($this->_appnames as $appname){
                $optionArray[] = array('value' => $appname, 'label'=>$appname);
            }
        } catch (Exception $e){
            Mage::logException($e);
        }    
        return $optionArray;
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return $this->_appnames;
    }

}
