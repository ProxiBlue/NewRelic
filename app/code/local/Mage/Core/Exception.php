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
 * */

/**
 * Magento Core Exception
 *
 * This class will be extended by other modules
 *
 * @category   Mage
 * @package    Mage_Core
 */
class Mage_Core_Exception extends Exception {

    protected $_messages = array();
    protected $_lastException = null;

    public function addMessage(Mage_Core_Model_Message_Abstract $message) {
        if (!isset($this->_messages[$message->getType()])) {
            $this->_messages[$message->getType()] = array();
        }
        $this->_messages[$message->getType()][] = $message;
        return $this;
    }

    public function getMessages($type = '') {
        if ('' == $type) {
            $arrRes = array();
            foreach ($this->_messages as $messageType => $messages) {
                $arrRes = array_merge($arrRes, $messages);
            }
            return $arrRes;
        }
        return isset($this->_messages[$type]) ? $this->_messages[$type] : array();
    }

    /**
     * Set or append a message to existing one
     *
     * @param string $message
     * @param bool $append
     * @return Mage_Core_Exception
     */
    public function setMessage($message, $append = false) {
        if ($append) {
            $this->message .= $message;
        } else {
            $this->message = $message;
        }
        return $this;
    }

    /**
     * Additions by ProxiBlue to log exceptions with new relic.
     * 
     */
    public function __construct($message = '', $code = 0, $previous = null) {
        parent::__construct($message, $code, $previous);
        if ($this instanceof Mage_Core_Model_Store_Exception || $this instanceof ProxiBlue_NewRelic_Exception) {
            // this is a store or newrelic module exception
            // log this one direct to newrelic to prevent endless loop.
            ProxiBlue_NewRelic_Model_Log_Exception::pushEvent($this, false);
        } else {
            // determine if this is a Mage_Core_Model_Config exception, prevents endless loop
            $stackTrace = self::getTrace();
            if (is_array($stackTrace)) {
                $maxTraceItterations = 100;
                // 100 seems like a safe test. If this test works, a config option would be created to allow users to set this.
                foreach ($stackTrace as $_trace) {
                    if($maxTraceItterations == 0) {
                        break;
                    }
                    if (is_array($_trace) && array_key_exists('class', $_trace) && $_trace['class'] == 'Mage_Core_Model_Config') {
                        // some config issue, log it direct
                        ProxiBlue_NewRelic_Model_Log_Exception::pushEvent($this, false);
                        return $this;
                    }
                    $maxTraceItterations--;
                }
            }
            $newRelic = Mage::getModel('proxiblue_newrelic/log_Exception');
            // make sure we have an object here!
            if (is_object($newRelic) && $newRelic instanceof ProxiBlue_NewRelic_Model_Log_Exception && $newRelic->getEnabled()) {
                $newRelic->recordEvent($this);
            }
        }
    }

}
