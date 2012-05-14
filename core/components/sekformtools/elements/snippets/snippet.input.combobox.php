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

$tplContainer = $modx->getOption('tplContainer',$scriptProperties,'input.combobox');
$input_id = $modx->getOption('input_id',$scriptProperties,'combobox');
$name =  $modx->getOption('name',$scriptProperties,'');
$value = $modx->getOption('value',$scriptProperties,'');

$sekformtools->loadSettings(
    $modx->getOption('loadjquery',$scriptProperties,'')
    ,$modx->getOption('theme',$scriptProperties,'')
    ,$modx->getOption('customcss',$scriptProperties,''));

$type = $modx->getOption('type',$scriptProperties,'autocomplete');
$object = $modx->getOption('object',$scriptProperties,'');
$snippet = $modx->getOption('snippet',$scriptProperties,'');
$value_list = $modx->getOption('value_list',$scriptProperties,'');
$filter = $modx->getOption('filter',$scriptProperties,'');
$helper_snippet = $modx->getOption('helper_snippet',$scriptProperties,'');
$jsUrl = $sekformtools->config['jsUrl'].'web/';

$fltinputid = '';
$fltname = '';
$fltfield = '';
$fltvalue = '';
if($filter > '') {
    $filterArray = $modx->fromJSON($filter);
    $fltinputid = isset($filterArray["input_id"])?$filterArray['input_id']:'';
    $fltname = isset($filterArray["name"])?$filterArray['name']:'';
    $fltfield = isset($filterArray["field"])?$filterArray['field']:'';
    $fltvalue = isset($filterArray["value"])?$filterArray['value']:'';
}

$objname = '';
$objsortby = '';
$objgroupby = '';
$objvalue =  '';
$objlabel =  '';
if($object > '') {
    $objectArray = $modx->fromJSON($object);
    $objname = isset($objectArray['name'])?$objectArray['name']:'';
    $objsortby = isset($objectArray['sortby'])?$objectArray['sortby']:'';
    $objgroupby = isset($objectArray['groupby'])?$objectArray['groupby']:'';
    $objvalue = isset($objectArray['value'])?$objectArray['value']:'';
    $objlabel = isset($objectArray['label'])?$objectArray['label']:'';
}

$modx->regClientScript($jsUrl.'ui.combobox.'.$type.'.js');
$jscript = '';
if ( $fltinputid > '' && $fltname > '' && $fltfield > '' && $fltvalue > '' ){
    $helper_url = html_entity_decode($modx->makeUrl($modx->getOption('sekformtools.helper_resource_id'),'',array(
        'hs' => $helper_snippet
        ,'objname' => $objname
        ,'objsortby' => $objsortby
        ,'objgroupby' => $objgroupby
        ,'objvalue' => $objvalue
        ,'objlabel' => $objlabel
        ,'fltname' => $fltname
        ,'fltfield' => $fltfield
    )));
    $jscript = ( $filter ) ? '
        $( "#'.$fltinputid.'" ).combobox({
            selected: function(e, ui) {
                $("#ui-'.$input_id.'").addClass( "ui-autocomplete-loading" );
                $("#ui-'.$input_id.'").prop("disabled", true);
                $("#ui-'.$input_id.'").val("");
                $("#'.$input_id.'").find("option").remove()
                $.getJSON("'.$helper_url.'&fltvalue="+ui.item.value, function(result) {
                    $.each(result, function(key, item) {
                        $("#'.$input_id.'")
                            .append($("<option></option>")
                            .attr("value",item.value)
                            .text(item.label));
                    });
                });
                $("#ui-'.$input_id.'").prop("disabled", false);
                $("#ui-'.$input_id.'").removeClass( "ui-autocomplete-loading" );
            }
        });
    ' : '';
}
$jscript = '<script>
	$(function() {
        $( "#'.$input_id.'" ).combobox();
    });'.$jscript.'
	</script>';
$modx->regClientScript($jscript);

$itemComboList = '';// '<option value="">Select one...</option>';
$itemsArray = array();

if($value_list > '') {
    $itemsArray = $modx->fromJSON($value_list);
    foreach ($itemsArray as $item) {
        $selected = ($item['value']==$value)?' selected="selected"':'';
        $itemComboList .= '<option value="'.$item['value'].'"'.$selected.'>'.$item['label'].'</option>';
    }
}

if($object > '') {
    $c = $modx->newQuery($objname);
    if($objsortby > ''){
        $c->sortby($objsortby,'ASC');
    }
    if($objgroupby > ''){
        $c->groupby($objgroupby);
    }

    if($fltname > '' && $fltfield > '' && $fltvalue > '') {
        $parent = $modx->getObject($fltname,array($fltfield => $fltvalue));
        $items = $parent->getMany($objname,$c);
    }else{
        if($filter) {
            $whereArray = array();
            $c->where(array($fltfield => $fltvalue));
        }
        $items = $modx->getCollection($objname,$c);
    }

    foreach ($items as $item) {
        $itemArray = $item->toArray();
        $selected = ($itemArray[$objvalue]==$value)?' selected="selected"':'';
        $itemComboList .= '<option value="'.$itemArray[$objvalue].'"'.$selected.'>'.$itemArray[$objlabel].'</option>';
    }

}else{
    if($snippet > '') {
        if ($modx->getObject('modSnippet',array('name' => $snippet))) {
            $itemsArray = $modx->fromJSON($modx->runSnippet($snippet));
        }
        foreach ($itemsArray as $item) {
            $selected = ($item['value']==$value)?' selected="selected"':'';
            $itemComboList .= '<option value="'.$item['value'].'"'.$selected.'>'.$item['label'].'</option>';
        }
    }

}

$link_template =  $sekformtools->getChunk($tplContainer, array(
    'input_id' => $input_id
    ,'name' => $name
    ,'value' => $value
    ,'option_list' => $itemComboList
));
return $link_template;