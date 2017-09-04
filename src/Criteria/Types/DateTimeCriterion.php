<?php

namespace BeatSwitch\Distil\Criteria\Types;

use BeatSwitch\Distil\Criteria\Criterion;
use BeatSwitch\Distil\Criteria\Exceptions\InvalidCriterionValue;
use BeatSwitch\Distil\Criteria\Keywords\Keyword;
use BeatSwitch\Distil\Criteria\Keywords\Value;
use BeatSwitch\Distil\Criteria\OneOffCriteria;
use DateTime;
use DateTimeImmutable;
use DateTimeInterface;

abstract class DateTimeCriterion implements Criterion
{
    use OneOffCriteria;

    /**
     * @var DateTimeInterface
     */
    private $value;

    /**
     * @var string
     */
    private $format;

    public function __construct(DateTimeInterface $value, string $format = DateTime::ATOM)
    {
        $this->value = $value;
        $this->format = $format;
    }

    /**
     * @return static
     */
    public static function fromString(string $value, string $format = DateTime::ATOM): self
    {
        $value = (new Keyword(static::class, $value))->value();

        if ($value instanceof DateTimeInterface) {
            return new static($value, $format);
        } elseif (strtotime($value)) {
            return new static(new DateTimeImmutable($value), $format);
        }

        throw InvalidCriterionValue::expectedTimeString(static::class);
    }

    public function value(): DateTimeInterface
    {
        return $this->value;
    }

    public function format(): string
    {
        return $this->format;
    }

    public function __toString(): string
    {
        return (new Value($this, $this->value))->keyword() ?: $this->value->format($this->format);
    }
}
