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

$tplContainer = $modx->getOption('tplContainer',$scriptProperties,'input.autocomplete');
$input_id = $modx->getOption('input_id',$scriptProperties,'autocomplete');
$name =  $modx->getOption('name',$scriptProperties,'');
$value = $modx->getOption('value',$scriptProperties,'');
$helper_resource_id = $modx->getOption('value',$scriptProperties,$modx->getOption('sekformtools.helper_resource_id'));
$helper_snippet = $modx->getOption('helper_snippet',$scriptProperties,'');

$sekformtools->loadSettings(
    $modx->getOption('loadjquery',$scriptProperties,'')
    ,$modx->getOption('theme',$scriptProperties,'')
    ,$modx->getOption('customcss',$scriptProperties,''));

$object = $modx->getOption('object',$scriptProperties,'');
$filter = $modx->getOption('filter',$scriptProperties,'');
$min_length = $modx->getOption('min_length',$scriptProperties,'2');
$max_rows = $modx->getOption('max_rows',$scriptProperties,'15');

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

$helper_url = html_entity_decode($modx->makeUrl($modx->getOption('sekformtools.helper_resource_id'),'',array(
    'hs' => $helper_snippet
    ,'objname' => $objname
    ,'objsortby' => $objsortby
    ,'objgroupby' => $objgroupby
    ,'objvalue' => $objvalue
    ,'objlabel' => $objlabel
)));

$selected_action = '';
/*    ',select: function( event, ui ) {
    /* log( ui.item ?
            "Selected: " + ui.item.value + " aka " + ui.item.id :
            "Nothing selected, input was " + this.value );   * /
    }'; */

$js_filter = '';
if ( $fltname > '' ){
    $js_filter .= 'fltname: "'.$fltname.'",';
}
if ( $fltfield > '' ){
    $js_filter .= 'fltfield: "'.$fltfield.'",';
}
if ( $fltinputid > ''){
    $js_filter .= 'fltvalue: $("#'.$fltinputid.'").val(),';
}

$jscript = '<script>
$(function() {
    $( "#'.$input_id.'" ).autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "'.$helper_url.'",
                datatype: "dataType",
                data: {
                    term: request.term,
                    '.$js_filter.'
                    maxRows: '.$max_rows.'
                },
                success: function(data) {
                    var output = jQuery.parseJSON(data);
                    response($.map(output, function(item) {
                        return {
                            label: item.label,
                            value: item.value
                        };
                    }));
            });
        },
        minLength: '.$min_length.
        $selected_action.'
    });
});
</script>';
$modx->regClientScript($jscript);

$link_template =  $sekformtools->getChunk($tplContainer, array(
    'input_id' => $input_id
    ,'name' => $name
    ,'value' => $value
));
return $link_template;