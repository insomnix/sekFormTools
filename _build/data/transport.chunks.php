<?php
/**
 * Form Tools
 *
 * Copyright 2012 by Stephen Smith <ssmith@seknetsolutions.com>
 *
 * sekFormTools is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation; either version 2 of the License, or (at your option) any
 * later version.
 *
 * sekFormTools is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * sekFormTools; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package sekformtools
 */
$chunks = array();

$chunks[1]= $modx->newObject('modChunk');
$chunks[1]->fromArray(array(
    'id' => 1,
    'name' => 'input.autocomplete',
    'description' => 'Auto complete input field.',
    'snippet' => file_get_contents($sources['elements'].'/chunks/input.autocomplete.chunk.tpl'),
    'properties' => '',
),'',true,true);

$chunks[2]= $modx->newObject('modChunk');
$chunks[2]->fromArray(array(
    'id' => 2,
    'name' => 'input.combobox',
    'description' => 'Combo box input field.',
    'snippet' => file_get_contents($sources['elements'].'/chunks/input.combobox.chunk.tpl'),
    'properties' => '',
),'',true,true);

$chunks[3]= $modx->newObject('modChunk');
$chunks[3]->fromArray(array(
    'id' => 3,
    'name' => 'input.datepicker',
    'description' => 'Date picker input field.',
    'snippet' => file_get_contents($sources['elements'].'/chunks/input.datepicker.chunk.tpl'),
    'properties' => '',
),'',true,true);

$chunks[4]= $modx->newObject('modChunk');
$chunks[4]->fromArray(array(
    'id' => 4,
    'name' => 'input.textfield',
    'description' => 'Text input field with prompt.',
    'snippet' => file_get_contents($sources['elements'].'/chunks/input.textfield.chunk.tpl'),
    'properties' => '',
),'',true,true);

return $chunks;
