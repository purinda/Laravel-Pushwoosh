# Laravel Pushwoosh

![pushwoosh](https://cloud.githubusercontent.com/assets/499192/12697005/8eb625dc-c778-11e5-9041-3f4bdee8cb06.png)

Laravel [Pushwoosh](https://www.pushwoosh.com) is a [Pushwoosh](https://www.pushwoosh.com) bridge for Laravel using the [Gomoob's](https://github.com/gomoob) [Pushwoosh package](https://github.com/gomoob/php-pushwoosh).

```php
// Create a new notification.
$notification = Notification::create()->setContent('Hello Jean !');

// Create a request for the '/createMessage' web service.
$request = CreateMessageRequest::create()->addNotification($notification);

// Send out the notification.
$response = $pushwoosh->createMessage($request);

// Check if it was sent ok.
$response->isOk();
```

[![Build Status](https://img.shields.io/travis/hoymultimedia/Laravel-Pushwoosh/master.svg?style=flat)](https://travis-ci.org/hoymultimedia/Laravel-Pushwoosh)
[![StyleCI](https://styleci.io/repos/34845881/shield?style=flat)](https://styleci.io/repos/34845881)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/hoymultimedia/Laravel-Pushwoosh.svg?style=flat)](https://scrutinizer-ci.com/g/hoymultimedia/Laravel-Pushwoosh/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/hoymultimedia/Laravel-Pushwoosh.svg?style=flat)](https://scrutinizer-ci.com/g/hoymultimedia/Laravel-Pushwoosh)
[![Latest Version](https://img.shields.io/github/release/hoymultimedia/Laravel-Pushwoosh.svg?style=flat)](https://github.com/hoymultimedia/Laravel-Pushwoosh/releases)
[![License](https://img.shields.io/packagist/l/hoy/pushwoosh.svg?style=flat)](https://packagist.org/packages/hoy/pushwoosh)

## Installation
Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

```bash
composer require hoy/pushwoosh
```

Add the service provider to `config/app.php` in the `providers` array.

```php
Hoy\Pushwoosh\PushwooshServiceProvider::class
```

If you want you can use the [facade](http://laravel.com/docs/facades). Add the reference in `config/app.php` to your aliases array.

```php
'Pushwoosh' => Hoy\Pushwoosh\Facades\Pushwoosh::class
```

## Configuration

Laravel Pushwoosh requires connection configuration. To get started, you'll need to publish all vendor assets:

```bash
php artisan vendor:publish
```

This will create a `config/pushwoosh.php` file in your app that you can modify to set your configuration. Also, make sure you check for changes to the original config file in this package between releases.

#### Default Connection Name

This option `default` is where you may specify which of the connections below you wish to use as your default connection for all work. Of course, you may use many connections at once using the manager class. The default value for this setting is `main`.

#### Pushwoosh Connections

This option `connections` is where each of the connections are setup for your application. Example configuration has been included, but you may add as many connections as you would like.

## Usage

#### PushwooshManager

This is the class of most interest. It is bound to the ioc container as `pushwoosh` and can be accessed using the `Facades\Pushwoosh` facade. This class implements the ManagerInterface by extending AbstractManager. The interface and abstract class are both part of [Graham Campbell's](https://github.com/GrahamCampbell) [Laravel Manager](https://github.com/GrahamCampbell/Laravel-Manager) package, so you may want to go and checkout the docs for how to use the manager class over at that repository. Note that the connection class returned will always be an instance of `Gomoob\Pushwoosh\Client\Pushwoosh`.

#### Facades\Pushwoosh

This facade will dynamically pass static method calls to the `pushwoosh` object in the ioc container which by default is the `PushwooshManager` class.

#### PushwooshServiceProvider

This class contains no public methods of interest. This class should be added to the providers array in `config/app.php`. This class will setup ioc bindings.

### Examples
Here you can see an example of just how simple this package is to use. Out of the box, the default adapter is `main`. After you enter your authentication details in the config file, it will just work:

```php
// You can alias this in config/app.php.
use Hoy\Pushwoosh\Facades\Pushwoosh;

Pushwoosh::createMessage($request);
// We're done here - how easy was that, it just works!

Pushwoosh::getApplication();
// This example is simple and there are far more methods available.
```

The Pushwoosh manager will behave like it is a `Gomoob\Pushwoosh\Client\Pushwoosh`. If you want to call specific connections, you can do that with the connection method:

```php
use Hoy\Pushwoosh\Facades\Pushwoosh;

// Writing this…
Pushwoosh::connection('main')->createMessage($request);

// …is identical to writing this
Pushwoosh::createMessage($request);

// and is also identical to writing this.
Pushwoosh::connection()->createMessage($request);

// This is because the main connection is configured to be the default.
Pushwoosh::getDefaultConnection(); // This will return main.

// We can change the default connection.
Pushwoosh::setDefaultConnection('alternative'); // The default is now alternative.
```

If you prefer to use dependency injection over facades like me, then you can inject the manager:

```php
use Hoy\Pushwoosh\PushwooshManager;

class Foo
{
	protected $pushwoosh;

	public function __construct(PushwooshManager $pushwoosh)
	{
		$this->pushwoosh = $pushwoosh;
	}

	public function bar($request)
	{
		$this->pushwoosh->createMessage($request);
	}
}

App::make('Foo')->bar();
```

## Documentation
There are other classes in this package that are not documented here. This is because the package is a Laravel wrapper of [Gomoob's](https://github.com/gomoob) [Pushwoosh package](https://github.com/gomoob/php-pushwoosh).

## License

Laravel Pushwoosh is licensed under [The MIT License (MIT)](LICENSE).
