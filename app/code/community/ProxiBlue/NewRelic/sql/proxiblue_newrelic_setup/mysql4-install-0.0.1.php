<?php
$installer = $this;
$installer->startSetup();

$config = new Mage_Core_Model_Config();
$config ->saveConfig('wishlist/general/active', 1, 'default', 0);
$installer->endSetup();


