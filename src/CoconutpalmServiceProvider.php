<?php

namespace Codeurco\Coconutpalm;

use Codeurco\Coconutpalm\ConfigFileMaker\Cdn\AmazonS3;
use Codeurco\Coconutpalm\ConfigFileMaker\ConfigFileMaker;
use Codeurco\Coconutpalm\VideoEncoder;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class CoconutpalmServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/coconutpalm.php' => config_path('coconutpalm.php'),
        ], 'coconutpalm');

        $this->mergeConfigFrom(
            __DIR__.'/config/coconutpalm.php', 'coconutpalm'
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;
      
        $app->bind('coconutpalm', function ($app) {
            return new Coconutpalm($app->make(VideoEncoder::class));
        });

        $app->alias('coconutpalm', Coconutpalm::class);
        
        $app->bind(ConfigFileMaker::class, function () {
            if (config('coconutpalm.cdn.use') == 's3') {
                return new AmazonS3();
            }
        });

    }
}
