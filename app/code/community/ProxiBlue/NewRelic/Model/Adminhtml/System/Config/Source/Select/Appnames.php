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
    public function __construct()
    {
        $appnames = Mage::getStoreConfig('newrelic/appnames/lookup');
        if (!is_string($appnames)) {
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
            foreach ($this->_appnames as $appname) {
                $optionArray[] = array('value' => $appname, 'label' => $appname);
            }
        } catch (Exception $e) {
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