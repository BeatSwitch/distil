<?php

namespace spec\BeatSwitch\Distil\Keywords;

use BeatSwitch\Distil\Criterion;
use BeatSwitch\Distil\Keywords\Keyword;
use BeatSwitch\Distil\Stubs\KeywordableCriterionStub;
use PhpSpec\ObjectBehavior;

class KeywordSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(KeywordableCriterionStub::class, KeywordableCriterionStub::KEYWORD);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Keyword::class);
    }

    function it_can_return_the_value_associated_with_the_keyword()
    {
        $this->value()->shouldReturn(null);
    }

    function it_returns_the_keyword_as_value_when_it_has_no_associated_value()
    {
        $this->beConstructedWith(KeywordableCriterionStub::class, 'rubbish');

        $this->value()->shouldReturn('rubbish');
    }

    function it_returns_the_keyword_as_value_when_the_criterion_class_is_not_keywordable()
    {
        $this->beConstructedWith(Criterion::class, 'foo');

        $this->value()->shouldReturn('foo');
    }
}