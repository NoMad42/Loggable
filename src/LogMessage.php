<?php

namespace NoMad42\Loggable;

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
}
