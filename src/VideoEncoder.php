<?php 

namespace Codeurco\Coconutpalm;

use Codeurco\Coconutpalm\ConfigFileMaker\ConfigFileMaker;

class VideoEncoder {

	/** @var \Codeurco\Coconutpalm\ConfigFileMaker\ConfigFileMaker */
	protected $configFileMaker;

	/**
	 * Class constructor
	 */
	public function __construct(ConfigFileMaker $configFileMaker)
	{
		$this->configFileMaker = $configFileMaker;
	}

	/**
	 * Tell Coconut to convert the video file
	 * @param  string $file
	 * @return boolean
	 */
	public function lauchConversion($file)
	{
		$configFile = $this->configFileMaker->makeConfigurationFile($file);
		$configuration = $this->configFileMaker->getConfigurationFileContent($configFile);

		$job = \Coconut_Job::create([
			'api_key' => config('coconutpalm.api_key'),
			'conf' => $configFile,
		]);

		if($job->{"status"} != "ok") 
		{
			echo "An error has occured<br />";
		    echo $job->{"error_code"} . '<br />';
		    echo $job->{"message"};
		}

		return true;
	}

}