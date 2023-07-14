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
