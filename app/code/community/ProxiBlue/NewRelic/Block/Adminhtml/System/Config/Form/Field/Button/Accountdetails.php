<?php 

/**
 * Button for account details screen
 * 
 * @category   ProxiBlue
 * @package    ProxiBlue_NewRelic
 * @author     Lucas van Staden (support@proxiblue.com.au)
 **/

class ProxiBlue_NewRelic_Block_Adminhtml_System_Config_Form_Field_Button_AccountDetails extends Mage_Adminhtml_Block_System_Config_Form_Field
{

    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        $this->setElement($element);
        

        $html = $this->getLayout()->createBlock('adminhtml/widget_button')
                    ->setType('button')
                    ->setClass('scalable')
                    ->setLabel('Fetch Account Details')
                    ->setOnClick("fetchAccountDetails()")
                    ->toHtml();

        $html .= $this->addActionJs();
        return $html;
    }
    
    private function addActionJs(){
        $script = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_JS) . 'newrelic.js';
        $js = '<script type="text/javascript" src="'.$script.'"></script>';
        return $js;
    }
}
?>