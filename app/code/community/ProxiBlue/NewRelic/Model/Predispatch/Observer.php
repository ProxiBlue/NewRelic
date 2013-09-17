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
                    newrelic_ignore_transaction();
                    newrelic_ignore_apdex();
                    return $this;
                }
                if (mage::helper('newrelic')->ignoreModule($request->getModuleName()) === true) {
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
                    return $this;
                }
            }
        } catch (Exception $e) {
            mage::logException($e);
        }
    }

}
