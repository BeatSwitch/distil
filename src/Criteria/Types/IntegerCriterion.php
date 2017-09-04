<?php

namespace BeatSwitch\Distil\Criteria\Types;

use BeatSwitch\Distil\Criteria\Criterion;
use BeatSwitch\Distil\Criteria\Exceptions\InvalidCriterionValue;
use BeatSwitch\Distil\Criteria\Keywords\Keyword;
use BeatSwitch\Distil\Criteria\Keywords\Value;
use BeatSwitch\Distil\Criteria\OneOffCriteria;

abstract class IntegerCriterion implements Criterion
{
    use OneOffCriteria;

    /**
     * @var int|null
     */
    private $value;

    public function __construct(?int $value)
    {
        $this->value = $value;
    }

    /**
     * @return static
     */
    public static function fromString(string $value): self
    {
        $value = (new Keyword(static::class, $value))->value();

        if ($value === null || is_numeric($value)) {
            return new static($value ? (int) $value : $value);
        }

        throw InvalidCriterionValue::expectedNumeric(static::class);
    }

    public function value(): ?int
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (new Value($this, $this->value))->keyword() ?: (string) $this->value;
    }
}