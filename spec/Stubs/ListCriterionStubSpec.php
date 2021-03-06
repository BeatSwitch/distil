<?php

namespace spec\Distil\Stubs;

use Distil\Criteria;
use Distil\Criterion;
use Distil\Exceptions\InvalidCriterionValue;
use Distil\Stubs\ListCriterionStub;
use Distil\Types\ListCriterion;
use PhpSpec\ObjectBehavior;

class ListCriterionStubSpec extends ObjectBehavior
{
    private const VALUE = ['foo', 'bar'];
    private const STRING_VALUE = 'foo,bar';

    function let()
    {
        $this->beConstructedWith(...self::VALUE);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ListCriterion::class);
        $this->shouldHaveType(Criterion::class);
    }

    function it_cannot_be_created_with_mixed_value_types()
    {
        $this->beConstructedWith(1, 'foo');

        $this->shouldThrow(InvalidCriterionValue::class)->duringInstantiation();
    }

    function it_can_return_its_name()
    {
        $this->name()->shouldReturn(ListCriterionStub::NAME);
    }

    function it_can_return_its_value()
    {
        $this->value()->shouldReturn(self::VALUE);
    }

    function it_can_be_created_from_a_string()
    {
        $this->beConstructedThrough('fromString', [self::STRING_VALUE]);

        $this->value()->shouldReturn(self::VALUE);
    }

    function it_can_be_casted_to_a_string()
    {
        $this->__toString()->shouldReturn(self::STRING_VALUE);
    }

    function it_can_act_as_criteria_factory()
    {
        $criteria = $this::criteria(1, 6);

        $criteria->shouldReturnAnInstanceOf(Criteria::class);
        $criteria[ListCriterionStub::NAME]->value()->shouldReturn([1, 6]);
    }
}
