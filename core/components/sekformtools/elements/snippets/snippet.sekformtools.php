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

$sekft = $modx->getService('sekformtools','sekFormTools',$modx->getOption('sekformtools.core_path',null,$modx->getOption('core_path').'components/sekformtools/').'model/sekformtools/',$scriptProperties);
if (!($sekft instanceof sekFormTools)) return '';

$output = '';
/* create tables */
$m = $modx->getManager();

$created = $m->createObjectContainer('sekftCountries');
$output .= $created ? 'sekftCountries Table created.<br />' : 'sekftCountries Table not created.<br />';

$created = $m->createObjectContainer('sekftStates');
$output .= $created ? 'sekftStates Table created.<br />' : 'sekftStates Table not created.<br />';

$created = $m->createObjectContainer('sekftUSCityZipXref');
$output .= $created ? 'sekftUSCityZipXref Table created.<br />' : 'sekftUSCityZipXref Table not created.<br />';

$created = $m->createObjectContainer('sekftUSZipCodes');
$output .= $created ? 'sekftUSZipCodes Table created.<br />' : 'sekftUSZipCodes Table not created.<br />';

$created = $m->createObjectContainer('sekftUSCities');
$output .= $created ? 'sekftUSCities Table created.<br />' : 'sekftUSCities Table not created.<br />';

return $output;
