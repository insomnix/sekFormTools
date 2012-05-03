<?php
$xpdo_meta_map['sekftUSCities']= array (
  'package' => 'sekformtools',
  'table' => 'sekft_uscities',
  'fields' => 
  array (
    'city_name' => '',
    'state_id' => 0,
  ),
  'fieldMeta' => 
  array (
    'city_name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
      'index' => 'unique',
      'indexgrp' => 'citystate',
    ),
    'state_id' => 
    array (
      'dbtype' => 'int',
      'attributes' => 'unsigned',
      'precision' => '10',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
      'index' => 'unique',
      'indexgrp' => 'citystate',
    ),
  ),
  'indexes' => 
  array (
    'citystate' => 
    array (
      'alias' => 'citystate',
      'primary' => false,
      'unique' => true,
      'columns' => 
      array (
        'city_name' => 
        array (
          'collation' => 'A',
          'null' => false,
        ),
        'state_id' => 
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
      'local' => 'id',
      'foreign' => 'city_id',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
  'aggregates' => 
  array (
    'sekftStates' => 
    array (
      'class' => 'sekftStates',
      'local' => 'state_id',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
