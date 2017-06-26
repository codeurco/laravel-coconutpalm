<?php

namespace Codeurco\Coconutpalm\ConfigFileMaker;

use Codeurco\Coconutpalm\Exceptions\InvalidFilePath;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

abstract class BaseConfigFileMaker implements ConfigFileMaker
{
	protected $websiteUrl;

	/**
	 * Set website url variable depending on application environment (dev or prod)
	 */
	protected function setBaseUrl() {	
		if ( env('APP_ENV') == 'local' )
		{
			$this->websiteUrl = config('coconutpalm.http_tunnel_url');
		}
		else 
		{
			$this->websiteUrl = env('APP_URL');
		}
	}

	/**
	 * Get the video sources folder 
	 * @return string
	 */
	protected function getVideosSrcPath()
	{
		return base_path(config('coconutpalm.videos_source_path'));
	}

	/**
	 * Get the video destination folder
	 * @return string
	 */
	protected function getVideosDestinationPath()
	{
		return base_path(config('coconutpalm.videos_destination_path'));
	}

	/**
	 * Check that a given file exists in the video sources folder
	 * @param  string $target
	 * @return boolean
	 */
	public function checkForFileExistance($target)
	{
		if ( ! file_exists($this->getVideosSrcPath() . $target)) {
			throw new InvalidFilePath('Path to the source file is not correct');
		}
		return true;
	}

	/**
	 * Set a random filename for the file which will further be processed
	 * @param string $existingName
	 */
	public function setRandomFilename($existingName)
	{
		$extension = File::extension($this->getVideosSrcPath() . $existingName);
		$newName = str_random(24);
		Storage::copy('/temp/videos/'.$existingName, '/public/videos/temp/' . $newName.".".$extension);
		return $newName;
	}

	/**
	 * Get the Coconut .conf file content
	 * @param  string $configFile
	 * @return 
	 */
	public function getConfigurationFileContent($configFile)
	{
		$handle = fopen($configFile, "r");
		$contents = fread($handle, filesize($configFile));
		fclose($handle);
		return $contents;
	}
}