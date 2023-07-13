<?php

namespace NoMad42\Loggable;

interface Loggable
{
    public function getLevel(): string;
    public function getMessage(): string|\Stringable;

    public function getContext(): array;
}
