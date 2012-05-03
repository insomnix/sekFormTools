<?php
$xpdo_meta_map['sekftUSCityZipXref']= array (
  'package' => 'sekformtools',
  'table' => 'sekft_uscityzipxref',
  'fields' => 
  array (
    'zip_id' => 0,
    'city_id' => 0,
  ),
  'fieldMeta' => 
  array (
    'zip_id' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
      'index' => 'pk',
      'indexgrp' => 'PRIMARY',
    ),
    'city_id' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
      'index' => 'pk',
      'indexgrp' => 'PRIMARY',
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
        'zip_id' => 
        array (
          'collation' => 'A',
          'null' => false,
        ),
        'city_id' => 
        array (
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
  ),
  'aggregates' => 
  array (
    'sekftUSZipCodes' => 
    array (
      'class' => 'sekftUSZipCodes',
      'local' => 'zip_id',
      'foreign' => 'zip_code',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
    'sekftUSCities' => 
    array (
      'class' => 'sekftUSCities',
      'local' => 'city_id',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
