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
class sekFormTools {
    public $modx;
    public $config = array();
	
    function __construct(modX &$modx,array $config = array()) {
        $this->modx =& $modx;
 
        $basePath = $this->modx->getOption('sekformtools.core_path',$config,$this->modx->getOption('core_path').'components/sekformtools/');
        $assetsUrl = $this->modx->getOption('sekformtools.assets_url',$config,$this->modx->getOption('assets_url').'components/sekformtools/');
        $this->config = array_merge(array(
            'basePath' => $basePath,
            'corePath' => $basePath,
            'modelPath' => $basePath.'model/',
            'controllersPath' => $basePath.'controllers/',
            'processorsPath' => $basePath.'processors/',
			'templatesPath' => $basePath.'templates/',
            'chunksPath' => $basePath.'elements/chunks/',
            'jsUrl' => $assetsUrl.'js/',
            'cssUrl' => $assetsUrl.'css/',
            'themesUrl' => $assetsUrl.'themes/',
            'assetsUrl' => $assetsUrl,
            'connectorUrl' => $assetsUrl.'connector.php',
        ),$config);
		
        $this->modx->addPackage('sekformtools',$this->config['modelPath']);
		/*
		if ($this->modx->lexicon) {
            $this->modx->lexicon->load('sekformtools:default');
        }*/
    }
	
	public function getChunk($name,$properties = array()) {
		$chunk = null;
		if (!isset($this->chunks[$name])) {
			$chunk = $this->_getTplChunk($name);
			if (empty($chunk)) {
				$chunk = $this->modx->getObject('modChunk',array('name' => $name));
				if ($chunk == false) return false;
			}
			$this->chunks[$name] = $chunk->getContent();
		} else {
			$o = $this->chunks[$name];
			$chunk = $this->modx->newObject('modChunk');
			$chunk->setContent($o);
		}
		$chunk->setCacheable(false);
		return $chunk->process($properties);
	}
	 
	private function _getTplChunk($name,$postfix = '.chunk.tpl') {
		$chunk = false;
		$f = $this->config['chunksPath'].strtolower($name).$postfix;
		if (file_exists($f)) {
			$o = file_get_contents($f);
			$chunk = $this->modx->newObject('modChunk');
			$chunk->set('name',$name);
			$chunk->setContent($o);
		}
		return $chunk;
	}

    public function loadSettings($loadjquery,$theme,$customcss){
        $jsUrl = $this->config['jsUrl'].'web/';
        $cssUrl = $this->config['cssUrl'].'web/';
        $themesUrl = $this->config['themesUrl'];

        $loadjquery = ($loadjquery>'')?$loadjquery:$this->modx->getOption('sekformtools.load_jquery',null,1);
        $theme = ($theme>'')?$theme:($this->modx->getOption('sekformtools.theme')>'')?$this->modx->getOption('sekformtools.theme'):'smoothness';
        $customcss = ($customcss>'')?$customcss:($this->modx->getOption('sekformtools.customcss')>'')?$this->modx->getOption('sekformtools.customcss'):$cssUrl.'sekformtools.css';

        $this->modx->regClientCSS($themesUrl.$theme.'/jquery-ui-1.8.20.custom.css');
        $this->modx->regClientCSS($customcss);
        if($loadjquery == 1){
            $this->modx->regClientStartupScript($jsUrl.'libs/jquery-1.7.2.min.js');
        }
        $this->modx->regClientScript($jsUrl.'libs/jquery-ui-1.8.20.custom.min.js');
    }
}