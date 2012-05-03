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

$objname = $_REQUEST['objname'];
$objsortby = $_REQUEST['objsortby'];
$objvalue = $_REQUEST['objvalue'];
$objlabel = $_REQUEST['objlabel'];
$fltname = $_REQUEST['fltname'];
$fltfield = $_REQUEST['fltfield'];
$fltvalue = $_REQUEST['fltvalue'];
$term = $_REQUEST['term'];

$c = $modx->newQuery($objname);
if($objsortby > ''){
    $c->sortby($objsortby,'ASC');
}
if($term > ''){
    $c->where(array(
        $objvalue.':LIKE' => '%'.$term.'%'
    ));
}

if($fltname > '' && $fltfield > '' && $fltvalue > '') {
    $parent = $modx->getObject($fltname,array($fltfield => $fltvalue));
    $items = $parent->getMany($objname,$c);
}else{
    $items = $modx->getCollection($objname,$c);
}

$array = array();
foreach ($items as $item) {
    $itemArray = $item->toArray();
    $row_array['value'] = $itemArray[$objvalue];
    $row_array['label'] = $itemArray[$objlabel];
    array_push($array, $row_array);
}
return json_encode($array);