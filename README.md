# PSR-3 compatible log message interface

[![Latest Version on Packagist](https://img.shields.io/packagist/v/nomad42/loggable.svg?style=flat-square)](https://packagist.org/packages/nomad42/loggable)
[![Tests](https://img.shields.io/github/actions/workflow/status/nomad42/loggable/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/nomad42/loggable/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/nomad42/loggable.svg?style=flat-square)](https://packagist.org/packages/nomad42/loggable)

This package have [PSR-3](https://www.php-fig.org/psr/psr-3/) compatible log message interface.
It can be useful for implementation messages that can be easily logged via `\Psr\Log\LoggerInterface::log` method.

## Installation

You can install the package via composer:

```bash
composer require nomad42/loggable
```

## Usage

This package can be used in different ways.

### With package LogMessage helper class

```php
$loggable = new NoMad42\Loggable\LogMessage(
    \Psr\Log\LogLevel::ERROR,
    'Some log message with {contextInformation}',
    [
        'contextInformation' => 'some context'
    ]
);

...

if ($loggable instanceof \NoMad42\Loggable\Loggable) {
    /** @var \Psr\Log\LoggerInterface $logger */
    $logger->log(
        $loggable->getLevel(),
        $loggable->getMessage(),
        $loggable->getContext(),
    );
}
```

### With your app exception variant

```php
class MyAppException extends Exception implements \NoMad42\Loggable\Loggable
{
    public function getLevel() : string
    {
        return \Psr\Log\LogLevel::CRITICAL;
    }
    
    public function getMessage() : string|\Stringable
    {
        return 'Critical error in my app'
    }
    
    public function getContext() : array
    {
        return [
            'exception' => $this;
        ]
    }
}

...

/** @var \Psr\Log\LoggerInterface $logger */
try {
    // some code
} catch (MyAppException $exception) {
    $logger->log(
        $exception->getLevel(),
        $exception->getMessage(),
        $exception->getContext(),
    );
} catch (\NoMad42\Loggable\Loggable $loggable) {
    $logger->log(
        $loggable->getLevel(),
        $loggable->getMessage(),
        $loggable->getContext(),
    );
} catch (Exception $exception) {
    $logger->error('Oh no!', ['exception' => $exception]);
}
```

### Etc

And many other ways...

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Arthur Makarov](https://github.com/NoMad42)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
