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
function getSnippetContent($filename) {
    $o = file_get_contents($filename);
    $o = trim(str_replace(array('<?php','?>'),'',$o));
    return $o;
}
$snippets = array();

$snippets[1]= $modx->newObject('modSnippet');
$snippets[1]->fromArray(array(
    'id' => 1,
    'name' => 'input.autocomplete',
    'description' => 'Auto complete input field.',
    'snippet' => getSnippetContent($sources['elements'].'snippets/snippet.input.autocomplete.php'),
),'',true,true);

$snippets[2]= $modx->newObject('modSnippet');
$snippets[2]->fromArray(array(
    'id' => 2,
    'name' => 'input.combobox',
    'description' => 'Combo box input field.',
    'snippet' => getSnippetContent($sources['elements'].'snippets/snippet.input.combobox.php'),
),'',true,true);

$snippets[3]= $modx->newObject('modSnippet');
$snippets[3]->fromArray(array(
    'id' => 3,
    'name' => 'input.datepicker',
    'description' => 'Date picker input field.',
    'snippet' => getSnippetContent($sources['elements'].'snippets/snippet.input.datepicker.php'),
),'',true,true);

$snippets[4]= $modx->newObject('modSnippet');
$snippets[4]->fromArray(array(
    'id' => 4,
    'name' => 'input.textfield',
    'description' => 'Text input field with prompt.',
    'snippet' => getSnippetContent($sources['elements'].'snippets/snippet.input.textfield.php'),
),'',true,true);

$snippets[5]= $modx->newObject('modSnippet');
$snippets[5]->fromArray(array(
    'id' => 5,
    'name' => 'input.helper',
    'description' => 'Helper snippet for combo box and auto complete.',
    'snippet' => getSnippetContent($sources['elements'].'snippets/snippet.input.helper.php'),
),'',true,true);

$snippets[6]= $modx->newObject('modSnippet');
$snippets[6]->fromArray(array(
    'id' => 6,
    'name' => 'helper.filter',
    'description' => 'Default helper snippet for combo box and auto complete.',
    'snippet' => getSnippetContent($sources['elements'].'snippets/snippet.helper.filter.php'),
),'',true,true);

$snippets[7]= $modx->newObject('modSnippet');
$snippets[7]->fromArray(array(
    'id' => 7,
    'name' => 'spellchecker',
    'description' => 'Add a spell checker to all text areas of a form.',
    'snippet' => getSnippetContent($sources['elements'].'snippets/snippet.spellchecker.php'),
),'',true,true);

return $snippets;