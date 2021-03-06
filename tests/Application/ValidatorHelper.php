<?php

namespace Tests\Application;

trait ValidatorHelper
{
    private array $expectedJsonStructure = [
        'status',
        'message',
        'data',
    ];

    private function validateJsonStructure(object $content): void
    {
        array_walk($this->expectedJsonStructure, function (string $expected) use ($content) {
            $this->assertObjectHasAttribute($expected, $content);
        });
    }
}
