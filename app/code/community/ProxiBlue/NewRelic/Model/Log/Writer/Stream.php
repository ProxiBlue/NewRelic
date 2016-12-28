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
 * Intercept logs to new relic
 *
 * @category   ProxiBlue
 * @package    ProxiBlue_NewRelic
 * @author     Lucas van Staden (support@proxiblue.com.au)
 **/
class ProxiBlue_Newrelic_Model_Log_Writer_Stream extends Zend_Log_Writer_Stream
{

    /**
     * Write a message to the log.
     *
     * @param  array $event event data
     * @return void
     */
    protected function _write($event)
    {
        parent::_write($event);
        // Log to NewRelic
        self::_log_to_newrelic($event);
    }

    /**
     * Record the event in New Relic
     *
     * @param  array $event event data
     * @return void
     */
    public static function _log_to_newrelic($event)
    {
        // Log the event to New Relic
        try {
            if (array_key_exists('priorityName', $event) && $event['priorityName'] != 'ERR') {
                $newRelic = Mage::getModel('proxiblue_newrelic/log_system');
                $newRelic->recordEvent($event);
            }
        } catch (Exception $e) {
            // cannot log it else we end up in a loop.
        }
    }
}