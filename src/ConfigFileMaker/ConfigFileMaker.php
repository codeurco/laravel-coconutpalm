<?php

namespace Codeurco\Coconutpalm\ConfigFileMaker;

interface ConfigFileMaker
{
	/**
	 * Make a configuration file for any supported CDN
	 * 
	 * See http://coconut.co/docs/tutorials/encoding-videos 
	 * for more info on configuration files
	 * 
	 * @return string
	 */
	public function makeConfigurationFile($videoSourceFile);
}