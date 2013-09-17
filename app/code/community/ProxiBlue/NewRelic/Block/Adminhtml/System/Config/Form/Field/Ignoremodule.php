<?php

/**
 * Admin form field Ignore Message
 * 
 * @category   ProxiBlue
 * @package    ProxiBlue_NewRelic
 * @author     Lucas van Staden (support@proxiblue.com.au)
 **/

class ProxiBlue_NewRelic_Block_Adminhtml_System_Config_Form_Field_Ignoremodule
    extends Mage_Adminhtml_Block_System_Config_Form_Field_Array_Abstract
{
    public function __construct()
    {
        $this->addColumn('string', array(
            'label' => Mage::helper('newrelic')->__('Module Name'),
            'style' => 'width:200px',
        ));
        $this->_addAfter = false;
        $this->_addButtonLabel = Mage::helper('newrelic')->__('Add New Ignore');
        parent::__construct();
    }
}