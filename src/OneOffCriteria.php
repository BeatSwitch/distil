<?php

namespace Distil;

trait OneOffCriteria
{
    public static function criteria(...$arguments): Criteria
    {
        return new Criteria(new static(...$arguments));
    }
}
