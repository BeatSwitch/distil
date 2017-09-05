<?php

namespace BeatSwitch\Distil\Stubs;

use BeatSwitch\Distil\Criterion;
use BeatSwitch\Distil\Keywords\Keywordable;

final class KeywordableCriterionStub implements Criterion, Keywordable
{
    const KEYWORD = 'keyword';

    public function name(): string
    {
        return 'keywordable';
    }

    public function value()
    {
        return 'Some Value';
    }

    public static function keywords(): array
    {
        return [self::KEYWORD => null];
    }
}