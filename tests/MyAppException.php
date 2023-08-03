<?php

namespace NoMad42\Loggable\Tests;

use Exception;
use NoMad42\Loggable\Loggable;
use Psr\Log\LogLevel;

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
