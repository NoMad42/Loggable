<?php

use NoMad42\Loggable\LogMessage;
use Psr\Log\LogLevel as PsrLogLevel;
use Psr\Log\NullLogger;

it('can be logged in null logger', function () {
    $logger = new NullLogger();
    $logMessage = new LogMessage(
        PsrLogLevel::DEBUG,
        'Test log message',
        ['key' => 'value'],
    );

    $logger->log(
        $logMessage->getLevel(),
        $logMessage->getMessage(),
        $logMessage->getContext()
    );
})->expectNotToPerformAssertions();

it('can be made from exception', function () {
    $logger = new NullLogger();
    $logMessage = LogMessage::makeFromException(
        new Exception('Oh no!')
    );

    $logger->log(
        $logMessage->getLevel(),
        $logMessage->getMessage(),
        $logMessage->getContext()
    );
})->expectNotToPerformAssertions();

it('can reassign fields value by method arguments', function () {
    $level = PsrLogLevel::CRITICAL;
    $message = 'Critical error!';
    $context = [
        'exception' => 'should not replace value',
        'key' => ' some value',
    ];
    $exception = new Exception('Oh no!');

    $logMessage = LogMessage::makeFromException(
        $exception,
        $level,
        $message,
        $context,
    );

    $context['exception'] = $exception;

    expect($logMessage->getLevel())->toBe($level);
    expect($logMessage->getMessage())->toBe($message);
    expect($logMessage->getContext())->toBe($context);
});
