<?php

namespace NoMad42\Loggable;

use Psr\Log\LogLevel;

class LogMessage implements Loggable
{
    public function __construct(
        protected string $level,
        protected string|\Stringable $message,
        protected array $context,
    ) {
    }

    public function getLevel(): string
    {
        return $this->level;
    }

    public function getMessage(): string|\Stringable
    {
        return $this->message;
    }

    public function getContext(): array
    {
        return $this->context;
    }

    public static function makeFromException(
        \Exception $exception,
        string $level = null,
        string|\Stringable $message = null,
        array $context = []
    ): LogMessage {
        return new LogMessage(
            $level ?? LogLevel::ERROR,
            $message ?? $exception->getMessage(),
            ['exception' => $exception] + $context,
        );
    }
}
