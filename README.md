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

### Standardize the workflow with logging your exception.

Step 1.

Implement interface in your exception.

```php
class MyAppException extends Exception implements Loggable
{
    public function getLevel(): string
    {
        return LogLevel::CRITICAL;
    }

    public function getContext(): array
    {
        return ['exception' => $this];
    }
}
```

Step 2.

At your error handler add one extra catch block.

```php
$logger = new NullLogger();

try {
    throw new MyAppException('Oh no!');
} catch (Loggable $exception) { // <- this block; yes, it can be caught 
    $logger->log(
        $exception->getLevel(),
        $exception->getMessage(),
        $exception->getContext(),
    );
} catch (Exception $exception) {
    $logger->error('Oh no!', ['exception' => $exception]);
}
```

### Wrap existing exception and log it immediately

```php
$exception = new \Exception('Oh no!');
$logger = new \Psr\Log\NullLogger();

LogMessage::makeFromException($exception)->logByLogger($logger);
```

### Log some data in easy way

```php
(new LogMessage(
    PsrLogLevel::INFO,
    'Cron task end successfully',
    ['metrics' => $metrics],
))->logByLogger($logger);
```

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
