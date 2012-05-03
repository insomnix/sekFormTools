<?php
$xpdo_meta_map['sekftUSZipCodes']= array (
  'package' => 'sekformtools',
  'table' => 'sekft_uszipcodes',
  'fields' => 
  array (
    'zip_code' => 0,
    'zip_lat' => 0,
    'zip_long' => 0,
  ),
  'fieldMeta' => 
  array (
    'zip_code' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
      'index' => 'pk',
    ),
    'zip_lat' => 
    array (
      'dbtype' => 'decimal',
      'precision' => '5,2',
      'phptype' => 'float',
      'null' => true,
      'default' => 0,
    ),
    'zip_long' => 
    array (
      'dbtype' => 'decimal',
      'precision' => '5,2',
      'phptype' => 'float',
      'null' => true,
      'default' => 0,
    ),
  ),
  'indexes' => 
  array (
    'PRIMARY' => 
    array (
      'alias' => 'PRIMARY',
      'primary' => true,
      'unique' => true,
      'columns' => 
      array (
        'zip_code' => 
        array (
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
  ),
  'composites' => 
  array (
    'sekftUSCityZipXref' => 
    array (
      'class' => 'sekftUSCityZipXref',
      'local' => 'zip_code',
      'foreign' => 'zip_id',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
);
