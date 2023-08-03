<?php

use NoMad42\Loggable\Loggable;
use NoMad42\Loggable\Tests\MyAppException;
use Psr\Log\NullLogger;

it('can be caught', function () {
    $logger = new NullLogger();

    try {
        throw new MyAppException('Oh no!');
    } catch (Loggable $exception) {
        $logger->log(
            $exception->getLevel(),
            $exception->getMessage(),
            $exception->getContext(),
        );
    } catch (Exception $exception) {
        $logger->error('Oh no!', ['exception' => $exception]);
    }
})->expectNotToPerformAssertions();
