<?php
$xpdo_meta_map['sekftStates']= array (
  'package' => 'sekformtools',
  'table' => 'sekft_states',
  'fields' => 
  array (
    'state_abbr' => '',
    'state_name' => '',
    'country_id' => 0,
  ),
  'fieldMeta' => 
  array (
    'state_abbr' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '2',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
      'index' => 'unique',
      'indexgrp' => 'statecountry',
    ),
    'state_name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'country_id' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
      'index' => 'unique',
      'indexgrp' => 'statecountry',
    ),
  ),
  'indexes' => 
  array (
    'statecountry' => 
    array (
      'alias' => 'statecountry',
      'primary' => false,
      'unique' => true,
      'columns' => 
      array (
        'state_abbr' => 
        array (
          'collation' => 'A',
          'null' => false,
        ),
        'country_id' => 
        array (
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
  ),
  'composites' => 
  array (
    'sekftUSCities' => 
    array (
      'class' => 'sekftUSCities',
      'local' => 'id',
      'foreign' => 'state_id',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
  'aggregates' => 
  array (
    'sekftCountries' => 
    array (
      'class' => 'sekftCountries',
      'local' => 'country_id',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
