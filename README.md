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

0.0.2 - Initial Public release.
0.0.3 - Bug fix release 
        - If 'Do Not record these log entries' was blank, then all system.log messages were ignored
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
0.1.2 - BUG Fix inverted exception exclusion logging   
0.1.3 - Remove observer events that is part of a new development version
 

See our other modules:
----------------------
Magento Gift Promotions: http://www.proxiblue.com.au/magento-gift-promotions.html
The ultimate magento goft promotions module - clean code, and it just works!

Magento Dynamic Category products: http://www.proxiblue.com.au/magento-dynamic-category-products.html
Dynamically assign any product to a category, using just attributes. Easy to create any type of 'Shopy By...' categories.

Magento Mapped Category Banners: http://www.proxiblue.com.au/magento-mapped-category-banners.html
Map unlimited click areas on category banner images to products (or direct links) Use that lost retail space to sell!
