<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

/* @var $connection Varien_Db_Adapter_Pdo_Mysql */
$connection  = $installer->getConnection();

$regionTable = $installer->getTable('directory/country_region');

/**
 * ISO 3166-2:PL
 * @link    https://en.wikipedia.org/wiki/ISO_3166-2:PL
 */
$regionsToIns = array(
    array('PL', 'PL-DS', 'Dolnoœl¹skie'),
    array('PL', 'PL-KP', 'Kujawsko-pomorskie'),
    array('PL', 'PL-LU', 'Lubelskie'),
    array('PL', 'PL-LB', 'Lubuskie'),
    array('PL', 'PL-LD', '£ódzkie'),
    array('PL', 'PL-MA', 'Ma³opolskie'),
    array('PL', 'PL-MZ', 'Mazowieckie'),
    array('PL', 'PL-OP', 'Opolskie'),
    array('PL', 'PL-PK', 'Podkarpackie'),
    array('PL', 'PL-PD', 'Podlaskie'),
    array('PL', 'PL-PM', 'Pomorskie'),
    array('PL', 'PL-SL', 'Œl¹skie'),
    array('PL', 'PL-SK', 'Œwiêtokrzyskie'),
    array('PL', 'PL-WN', 'Warmiñsko-mazurskie'),
    array('PL', 'PL-WP', 'Wielkopolskie'),
    array('PL', 'PL-ZP', 'Zachodniopomorskie'),
);

foreach ($regionsToIns as $row) {
    if (! ($connection->fetchOne("SELECT 1 FROM `{$regionTable}` WHERE `country_id` = :country_id && `code` = :code", array('country_id' => $row[0], 'code' => $row[1])))) {
        $connection->insert($regionTable, array(
            'country_id'   => $row[0],
            'code'         => $row[1],
            'default_name' => $row[2]
        ));
    }
}
