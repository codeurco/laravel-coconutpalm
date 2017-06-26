<?php

namespace Codeurco\Coconutpalm\ConfigFileMaker\Cdn;

use Codeurco\Coconutpalm\ConfigFileMaker\BaseConfigFileMaker;

class AmazonS3 extends BaseConfigFileMaker
{	
	/**
	 * Class constructor
	 */
	public function __construct()
	{
		$this->setBaseUrl();
	}

	/**
	 * Make the Amazon S3 formatted configuration file
	 * @param  string $videoSourceFile
	 * @return string 
	 */
	public function makeConfigurationFile($videoSourceFile)
	{
		$this->checkForFileExistance($videoSourceFile);

		$newFilename = $this->setRandomFilename($videoSourceFile);

		$videoFullPathWithoutExt = preg_replace('/.(webm|qt|mov|mp4|mpeg4|avi|flv|ogg)$/', '', $videoSourceFile);
		$videoFileNameWithoutExt = basename($videoFullPathWithoutExt);

		$configurationFile = fopen($this->getVideosDestinationPath() . $newFilename . '.conf' , 'w');

		$configuration =	'var access_key = ' . config('coconutpalm.cdn.s3.key') . "\n" .
							'var secret_key = ' . config('coconutpalm.cdn.s3.secret') . "\n" . 
							'var bucket = ' . config('coconutpalm.cdn.s3.bucket') . "\n" .
							'var cdn = s3://$access_key:$secret_key@$bucket' . "\n\n" .

							'set source = ' . $this->websiteUrl . str_replace('app/public/', '', config('coconutpalm.videos_destination_path')) . $newFilename . ".mp4\n" .
							'set webhook = ' . $this->websiteUrl .'/webhooks/coconut?videoID=' . $newFilename . "\n\n" ;
		
		$configuration .= '-> mp4 = $cdn/videos/' . $newFilename . '.mp4' . "\n";

		fwrite($configurationFile, $configuration);
		fclose($configurationFile);

		// Return the destination path
		return $this->getVideosDestinationPath() . $newFilename. ".conf";
	}

}