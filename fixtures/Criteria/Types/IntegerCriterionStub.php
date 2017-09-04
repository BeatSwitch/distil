<?php

namespace Fixtures\BeatSwitch\Distil\Criteria\Types;

use BeatSwitch\Distil\Criteria\Types\IntegerCriterion;

final class IntegerCriterionStub extends IntegerCriterion
{
    const NAME = 'integer_stub';

    public function name(): string
    {
        return self::NAME;
    }
}
