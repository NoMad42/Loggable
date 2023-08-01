<?php

it('can be logged in null logger', function () {
    $logger = new \Psr\Log\NullLogger();
    $logMessage = new \NoMad42\Loggable\LogMessage(
        \Psr\Log\LogLevel::DEBUG,
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
    $logger = new \Psr\Log\NullLogger();
    $logMessage = \NoMad42\Loggable\LogMessage::makeFromException(
        new Exception('Oh no!')
    );

    $logger->log(
        $logMessage->getLevel(),
        $logMessage->getMessage(),
        $logMessage->getContext()
    );
})->expectNotToPerformAssertions();

it('can reassign fields value by method arguments', function () {
    $level = \Psr\Log\LogLevel::CRITICAL;
    $message = 'Critical error!';
    $context = [
        'exception' => 'should not replace value',
        'key' => ' some value',
    ];
    $exception = new Exception('Oh no!');

    $logMessage = \NoMad42\Loggable\LogMessage::makeFromException(
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
