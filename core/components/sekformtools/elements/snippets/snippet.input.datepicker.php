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
$sekformtools = $modx->getService('sekformtools','sekFormTools',$modx->getOption('sekformtools.core_path',null,$modx->getOption('core_path').'components/sekformtools/').'model/sekformtools/',$scriptProperties);
if (!($sekformtools instanceof sekFormTools)) return '';

$tplContainer = $modx->getOption('tplContainer',$scriptProperties,'input.datepicker');
$input_id = $modx->getOption('input_id',$scriptProperties,'datepicker');
$name =  $modx->getOption('name',$scriptProperties,'');
$value = $modx->getOption('value',$scriptProperties,'');

$sekformtools->loadSettings(
    $modx->getOption('loadjquery',$scriptProperties,'')
    ,$modx->getOption('theme',$scriptProperties,'')
    ,$modx->getOption('customcss',$scriptProperties,''));

$menu = $modx->getOption('menu',$scriptProperties,'');
$date_format = $modx->getOption('date_format',$scriptProperties,'');
$min_date = $modx->getOption('min_date',$scriptProperties,'');
$max_date = $modx->getOption('max_date',$scriptProperties,'');
$animation = $modx->getOption('animation',$scriptProperties,'');

$options = '';
if($menu == '1'){
    $options .= ' changeMonth: true , changeYear: true ,';
}
if($date_format>''){
    $options .= ' dateFormat: \''.$date_format.'\' ,';
}
if($min_date>''){
    $options .= ' minDate: \''.$min_date.'\' ,';
}
if($max_date>''){
    $options .= ' maxDate: \''.$max_date.'\' ,';
}
if($animation>''){
    $options .= ' showAnim: \''.$animation.'\' ,';
}

if($options>''){
    $options = '{'.substr($options, 0, -1).'}';
}

$jscript = '<script>
				$(function() {
					$( "#'.$input_id.'" ).datepicker( '.$options.' );
				});
			</script>';
$modx->regClientScript($jscript);

// load chunk
$link_template =  $sekformtools->getChunk($tplContainer, array(
    'input_id' => $input_id
    ,'name' => $name
    ,'value' => $value
));
return $link_template;