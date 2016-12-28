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
 * Observers for custom metrics
 *
 * @category   ProxiBlue
 * @package    ProxiBlue_NewRelic
 * @author     Lucas van Staden (support@proxiblue.com.au)
 **/
class ProxiBlue_NewRelic_Model_Metrics
{

    /**
     * Hook to record customer account create metrics
     * @param Varien_Event_Observer $observer
     */

    public function customer_register_success(Varien_Event_Observer $observer)
    {
        if (Mage::getStoreConfig('newrelic/metrics/signup_success')) {
            Mage::helper('proxiblue_newrelic')->customMetric('Registration/Success', 1);
            return $this;
        }
    }
}