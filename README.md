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
0.0.2 - Initial Public release<br/>
0.0.3 - Bug fix release <br/>
        - If 'Do Not record these log entries' was blank, then all system.log messages were ignored<br/>
        - Fix typo in documentation. <br/>
0.0.4 - Bug fix release<br/>
        - Endless loop if error in config files. <br/>
        - Endless loop of module dependency fails<br/>
0.0.5 - change _writer method to public<br/>
0.1.0 - Add ability to ignore admin<br/>
      - Add ability to ignore modules<br/>
      - Add ability to name transactions<br/>
      - Add ability to add module name to named transactions<br/>
      - Move config menu option to proxiblue tab<br/>
0.1.1 - Bug Fix: #14 - Notice: undefined index 'class'<br/>
0.1.2 - BUG Fix inverted exception exclusion logging  <br/> 
0.1.3 - Remove observer events that is part of a new development version<br/>
0.1.4 - Further adjustments to set correct appname when using the newrelic php agent commands
      - Add license key field in admin, and adjust to populate correctly
0.1.5 - Adjust Exception push to not set appName if error is pushed direct from exceptions.
 

See our other modules:
----------------------
[Magento Gift Promotions](http://www.proxiblue.com.au/magento-gift-promotions.html)
The ultimate magento gift promotions module - clean code, and it just works!

[Magento Dynamic Category products](http://www.proxiblue.com.au/magento-dynamic-category-products.html)
Dynamically assign any product to a category, using just attributes. Easy to create any type of 'Shopy By...' categories.

[Magento Mapped Category Banners](http://www.proxiblue.com.au/magento-mapped-category-banners.html)
Map unlimited click areas on category banner images to products (or direct links) Use that lost retail space to sell!

