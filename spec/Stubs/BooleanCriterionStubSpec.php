<?php

namespace spec\Distil\Stubs;

use Distil\Criteria;
use Distil\Criterion;
use Distil\Exceptions\InvalidCriterionValue;
use Distil\Keywords\HasKeywords;
use Distil\Stubs\BooleanCriterionStub;
use Distil\Types\BooleanCriterion;
use PhpSpec\ObjectBehavior;

class BooleanCriterionStubSpec extends ObjectBehavior
{
    private const VALUE = true;

    function let()
    {
        $this->beConstructedWith(self::VALUE);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(BooleanCriterion::class);
        $this->shouldHaveType(Criterion::class);
        $this->shouldHaveType(HasKeywords::class);
    }

    function it_can_return_its_name()
    {
        $this->name()->shouldReturn(BooleanCriterionStub::NAME);
    }

    function it_can_return_its_value()
    {
        $this->value()->shouldReturn(self::VALUE);
    }

    function it_can_check_if_it_is_truthy()
    {
        $this->isTruthy()->shouldReturn(true);
        $this->isFalsy()->shouldReturn(false);
    }

    function it_can_check_if_it_is_falsy()
    {
        $this->beConstructedWith(false);

        $this->isTruthy()->shouldReturn(false);
        $this->isFalsy()->shouldReturn(true);
    }

    function it_can_be_created_from_a_string_with_a_valid_truthy_value()
    {
        $this->beConstructedThrough('fromString', [BooleanCriterion::KEYWORD_TRUE]);

        $this->value()->shouldReturn(true);
    }

    function it_can_be_created_from_a_string_with_a_valid_falsy_value()
    {
        $this->beConstructedThrough('fromString', [BooleanCriterion::KEYWORD_FALSE]);

        $this->value()->shouldReturn(false);
    }

    function it_cannot_be_created_from_a_string_with_an_invalid_boolean_value()
    {
        $this->beConstructedThrough('fromString', ['1']);

        $this->shouldThrow(InvalidCriterionValue::class)->duringInstantiation();
    }

    function it_can_be_casted_to_a_string()
    {
        $this->__toString()->shouldReturn(BooleanCriterion::KEYWORD_TRUE);
    }

    function it_can_act_as_criteria_factory()
    {
        $criteria = $this::criteria(self::VALUE);

        $criteria->shouldBeAnInstanceOf(Criteria::class);
        $criteria[BooleanCriterionStub::NAME]->value()->shouldReturn(self::VALUE);
    }
}
