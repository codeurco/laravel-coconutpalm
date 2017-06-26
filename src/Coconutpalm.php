<?php

namespace Codeurco\Coconutpalm;

use Codeurco\Coconutpalm\VideoEncoder;

class Coconutpalm {

	private $videoEncoder;

	/**
	 * Class constructor
	 * @param VideoEncoder $videoEncoder
	 */
	public function __construct(VideoEncoder $videoEncoder)
	{
		$this->videoEncoder = $videoEncoder;
	}

	/**
	 * Start the video encoding job
	 * @param  string $videoSourceFile
	 * @return void
	 */
	public function encode($videoSourceFile)
	{
		$this->videoEncoder->lauchConversion($videoSourceFile);
	}
}
