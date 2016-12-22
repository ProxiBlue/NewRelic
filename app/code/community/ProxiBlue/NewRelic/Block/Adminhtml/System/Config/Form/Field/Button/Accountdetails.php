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
 * Button for account details screen
 *
 * @category   ProxiBlue
 * @package    ProxiBlue_NewRelic
 * @author     Lucas van Staden (support@proxiblue.com.au)
 **/
class ProxiBlue_NewRelic_Block_Adminhtml_System_Config_Form_Field_Button_AccountDetails
    extends Mage_Adminhtml_Block_System_Config_Form_Field
{

    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        $this->setElement($element);
        $url = Mage::helper("adminhtml")->getUrl(
            "proxiblue_newrelic/api/accountDetails/", array('id' => Mage::getStoreConfig('newrelic/api/api_key'))
        );

        $html = $this->getLayout()->createBlock('adminhtml/widget_button')
            ->setType('button')
            ->setClass('scalable')
            ->setLabel('Fetch Account Details')
            ->setOnClick("fetchAccountDetails('{$url}')")
            ->toHtml();

        $html .= $this->addActionJs();
        return $html;
    }

    private function addActionJs()
    {
        $script = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_JS) . 'newrelic.js';
        $js = '<script type="text/javascript" src="' . $script . '"></script>';
        return $js;
    }
}

?>