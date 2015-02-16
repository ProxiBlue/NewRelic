NewRelic
========

Magento New Relic Integration
http://www.proxiblue.com.au/newrelic-magento-integration.html

This module will allow in depth connection between the amazing New Relic Performance Monitoring System and your Magento website. 
Uses the awesome New Relic API to submit and collect data.
Notice immediately what your Magento site is up to, and how it affects your site performance.

Compatible with Magento CE 1.4+ and EE 1.10+
Requirements:
New Relic Pro or higher for full functionality
New Relic PHP agent installed

Multiple Application Names After install
----------------------------------------

A few users have noted that after the module was installed, a new application name appeared in NewRelic.
Please see the answer on issue #17 which explains why this is happening (see the last answer by ProxiBlue)

The sweet and short: Make sure your application name in the newrelic agent ini is correct.


Features
--------
Mark Cache clear events on New Relic graphs <br/>
Mark Index events on New Relic graphs <br/>
Send log entries to New Relic Stack trace for log entries in New Relic <br/>
Send Magento exceptions to New Relic - Notice when your site has problems <br/>
Limit certain log and exception entries from logging to New Relic. Keep the 'noise' out, so you can focus on the real errors and events <br/>
Embed New Relic Graphs in your Dashboard. Make it easy to monitor your site performance directly from Magento admin <br/>
Retain in depth analytics in New Relic <br/>
Easy to install, <br/>
Easy to use Block admin access to be send metrics. Stop admin from scewing your apdex score! <br/>
Block specific modules to send metrics. <br/>
Ability to set named transactions <br/>
Ability to add module name to named transactions</br>
<br/>

This is not an official New Relic product, and is not endorsed by New Relic. This module is currently given FREE
</br>

Compatibility with Firegentoo Logger
------------------------------------
ref: https://github.com/firegento/firegento-logger

Edit the config.xml file of the ProxiBlue module.
Find the entry for the log writer.

        <log>
            <core>
                <writer_model>ProxiBlue_NewRelic_Model_Log_Writer_Stream</writer_model>
            </core>
        </log>

and change it to 

        <log>
            <core>
                <!-- <writer_model>ProxiBlue_NewRelic_Model_Log_Writer_Stream</writer_model> -->
                <writer_models>
                    <newrelic>
                        <label>ProxiBlue NewRelic Logger</label>
                        <class>ProxiBlue_NewRelic_Model_Log_Writer_Stream</class>
                    </newrelic>
                </writer_models>
            </core>
        </log>
        
After this change you will find an entry for the ProxiBlue NewRelic Logger in the Firegentoo Logger list of available loggers, and you can then controll logging to newRelic via the Inchoo Logger system



See our other modules:
----------------------
[Magento Gift Promotions](http://www.proxiblue.com.au/magento-gift-promotions.html)
The ultimate magento gift promotions module - clean code, and it just works!

[Magento Dynamic Category products](http://www.proxiblue.com.au/magento-dynamic-category-products.html)
Dynamically assign any product to a category, using just attributes. Easy to create any type of 'Shopy By...' categories.

[Magento Mapped Category Banners](http://www.proxiblue.com.au/magento-mapped-category-banners.html)
Map unlimited click areas on category banner images to products (or direct links) Use that lost retail space to sell!

