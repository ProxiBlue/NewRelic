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
 * */
class ProxiBlue_NewRelic_Model_PreDispatch_Observer {

    /**
     * Hook to record all fron controller events
     * @param Varien_Event_Observer $observer 
     */
    public function controller_action_predispatch(Varien_Event_Observer $observer) {
        try {
            if (extension_loaded('newrelic')) {

                $controllerAction = $observer->getControllerAction();
                $request = $controllerAction->getRequest();
                $controllerName = explode("_", $request->getControllerName());
                if (Mage::getStoreConfig('newrelic/settings/ignore_admin_routes') && $request->getRouteName() == 'adminhtml' || $request->getModuleName() == 'admin' || in_array('adminhtml', $controllerName)) {
                    Mage::Helper('newrelic')->setAppName(false);
                    newrelic_ignore_transaction();
                    newrelic_ignore_apdex();
                    return $this;
                }
                if (mage::helper('newrelic')->ignoreModule($request->getModuleName()) === true) {
                    Mage::Helper('newrelic')->setAppName(false);
                    newrelic_ignore_transaction();
                    newrelic_ignore_apdex();
                    return $this;
                }
                if (Mage::getStoreConfig('newrelic/settings/named_transactions')) {
                    $route = $request->getRouteName() . '/' . $request->getControllerName() . '/' . $request->getActionName();
                    if (Mage::getStoreConfig('newrelic/settings/add_module_to_named_transactions')) {
                        $route .= ' (module: ' . $request->getModuleName() . ')';
                    }
                    newrelic_name_transaction($route);
                    Mage::Helper('newrelic')->setAppName(true);
                    return $this;
                }
            }
        } catch (Exception $e) {
            mage::logException($e);
        }
    }

}