<?php

/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_Core
 * @copyright   Copyright (c) 2012 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

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
            ProxiBlue_NewRelic_Model_Log_Exception::pushEvent($this);
        } else {
            // determine if this is a Mage_Core_Model_Config exception, prevents endless loop
            $stackTrace = self::getTrace();
            if(is_array($stackTrace)){
                foreach($stackTrace as $_trace){
                    if(is_array($_trace) && array_key_exists('class',$_trace) && $_trace['class'] == 'Mage_Core_Model_Config') {
                        // some config issue, log it direct
                        ProxiBlue_NewRelic_Model_Log_Exception::pushEvent($this);
                        return $this;
                    }
                }
            } 
            $newRelic = mage::getModel('newrelic/log_Exception');
            // make sure we have an object here!
            if(is_object($newRelic) && $newRelic instanceof ProxiBlue_NewRelic_Model_Log_Exception) {
                $newRelic->recordEvent($this);
            }    

        }
    }
}
