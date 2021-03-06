<?php

namespace spec\Distil\Stubs;

use Distil\Criteria;
use Distil\Criterion;
use Distil\Exceptions\InvalidCriterionValue;
use Distil\Stubs\DateTimeCriterionStub;
use Distil\Types\DateTimeCriterion;
use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use PhpSpec\ObjectBehavior;

class DateTimeCriterionStubSpec extends ObjectBehavior
{
    private const VALUE = '2017-07-28T19:30:00+00:00';

    function let()
    {
        $this->beConstructedWith(new DateTimeImmutable(self::VALUE));
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(DateTimeCriterion::class);
        $this->shouldHaveType(Criterion::class);
    }

    function it_can_return_its_name()
    {
        $this->name()->shouldReturn(DateTimeCriterionStub::NAME);
    }

    function it_can_return_its_value()
    {
        $this->value()->shouldBeLike(new DateTimeImmutable(self::VALUE));
    }

    function it_can_return_its_default_format()
    {
        $this->format()->shouldReturn(DateTime::ATOM);
    }

    function it_can_be_created_with_a_format()
    {
        $this->beConstructedWith(new DateTimeImmutable(self::VALUE), DateTime::RSS);

        $this->format()->shouldReturn(DateTime::RSS);
    }

    function it_can_be_created_from_a_string_with_a_valid_datetime_value()
    {
        $this->beConstructedThrough('fromString', [self::VALUE]);

        $this->value()->shouldReturnAnInstanceOf(DateTimeInterface::class);
    }

    function it_cannot_be_created_from_a_string_with_a_non_numeric_value()
    {
        $this->beConstructedThrough('fromString', ['rubbish']);

        $this->shouldThrow(InvalidCriterionValue::class)->duringInstantiation();
    }

    function it_can_be_casted_to_a_string()
    {
        $this->__toString()->shouldReturn(self::VALUE);
    }

    function it_can_act_as_criteria_factory()
    {
        $value = new DateTimeImmutable(self::VALUE);
        $criteria = $this::criteria($value);

        $criteria->shouldBeAnInstanceOf(Criteria::class);
        $criteria[DateTimeCriterionStub::NAME]->value()->shouldReturn($value);
    }
}
