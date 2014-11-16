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

Change Log
----------
0.0.2 - Initial Public release.
0.0.3 - Bug fix release 
        - If 'Do Not record these log entries' was blank, then all system.log messages were ignored.
        - Fix typo in documentation. 
0.0.4 - Bug fix release
        - Endless loop if error in config files. 
        - Endless loop of module dependency fails
0.0.5 - change _writer method to public
0.1.0 - Add ability to ignore admin
      - Add ability to ignore modules
      - Add ability to name transactions
      - Add ability to add module name to named transactions
      - Move config menu option to proxiblue tab
0.1.1 - Bug Fix: #14 - Notice: undefined index 'class'
0.1.3 - Add appname to agent commands
0.1.4 - Further adjustments to set correct appname when using the newrelic php agent commands
      - Add license key field in admin, and adjust to populate correctly
0.1.5 - Adjust Exception push to not set appName if error is pushed direct from exceptions.
0.1.6 - Fix incorrect php closing tag - https://github.com/ProxiBlue/NewRelic/pull/10
0.1.7 - Change way that charts are embeded into dashboard
0.1.8 - Fix double >> in config.xml for closing tag
0.1.9 - Fixed ajax requests for cases when store is installed into a subfolder
 

See our other modules:
----------------------
[Magento Gift Promotions](http://www.proxiblue.com.au/magento-gift-promotions.html)
The ultimate magento gift promotions module - clean code, and it just works!

[Magento Dynamic Category products](http://www.proxiblue.com.au/magento-dynamic-category-products.html)
Dynamically assign any product to a category, using just attributes. Easy to create any type of 'Shopy By...' categories.

[Magento Mapped Category Banners](http://www.proxiblue.com.au/magento-mapped-category-banners.html)
Map unlimited click areas on category banner images to products (or direct links) Use that lost retail space to sell!

