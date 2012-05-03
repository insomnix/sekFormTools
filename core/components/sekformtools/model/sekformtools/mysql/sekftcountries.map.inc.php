<?php
$xpdo_meta_map['sekftCountries']= array (
  'package' => 'sekformtools',
  'table' => 'sekft_countries',
  'fields' => 
  array (
    'country_name' => '',
    'isoa_two' => '',
    'isoa_three' => '',
    'iso_number' => 0,
  ),
  'fieldMeta' => 
  array (
    'country_name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
      'null' => false,
      'index' => 'unique',
      'default' => '',
    ),
    'isoa_two' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '2',
      'phptype' => 'string',
      'null' => false,
      'index' => 'unique',
      'default' => '',
    ),
    'isoa_three' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '3',
      'phptype' => 'string',
      'null' => false,
      'index' => 'unique',
      'default' => '',
    ),
    'iso_number' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'index' => 'unique',
      'default' => 0,
    ),
  ),
  'composites' => 
  array (
    'sekftStates' => 
    array (
      'class' => 'sekftStates',
      'local' => 'id',
      'foreign' => 'country_id',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
);
