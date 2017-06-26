# laravel-coconutpalm
A Laravel 5 wrapper around [coconut](http://coconut.co) video encoding service library (for php).

This package is in its early development and there's still quite a lot of room for improvements. 
However, it's already working for simple Amazon S3 file uploads.

Feel free to read the [official coconut documentation](http://coconut.co/docs/) to see all the available features of the official package.

# Installation

```
composer require codeurco/laravel-coconutpalm:dev-master
```

Add the service provider to your `config\app.php` file

```
Codeurco\Coconutpalm\CoconutpalmServiceProvider::class
```

You can also use the Facade to the aliases array:
```
'Coconutpalm' => Codeurco\Coconutpalm\Facades\Coconutpalm::class;
```

# Configuration

To start using this package, you have to give the following info in your `.env` variables:

```
COCONUT_API_KEY=your_coconut_api_key

# used for local development
NGROK_TUNNEL_URL=ngrok_url

# currently only Amazon S3 is supported
COCONUT_CDN=s3

AWS_KEY=your_s3_key
AWS_SECRET=your_s3_secret
AWS_BUCKET=your_s3_bucket
```

Additionally you can change the default paths for you manipulated video files by published the configuration for this package.
You will then be able to modify  `videos_source_path` and `videos_destination_path` .


# Usage

To start encoding a file simply use this code

```
use Codeurco\Coconutpalm\Facades\Coconutpalm;

...

Coconutpalm::encode('SomeVideo.mp4');
```

Where `SomeVideo.mp4` points to a video located in your `videos_source_path`.
The video will be renamed, a configuration file gets created and the encoding job is then started with Coconut.


# Contributing

1. Fork it
2. Create your feature branch (`git checkout -b my-new-feature`)
3. Commit your changes (`git commit -am 'Added some feature'`)
4. Push to the branch (`git push origin my-new-feature`)
5. Create new Pull Request
