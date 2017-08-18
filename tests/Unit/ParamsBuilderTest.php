<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Library\Http\ParamsBuilder;

class ParamsBuilderTest extends TestCase
{
    public function testHas() {
        $paramsBuilder = new ParamsBuilder(['bacon' => 'delicious', 'mushrooms' => 'bad']);

        $this->assertTrue($paramsBuilder->has('bacon'));
        $this->assertTrue($paramsBuilder->has('mushrooms'));
        $this->assertFalse($paramsBuilder->has('tuna'));
    }

    public function testAdd() {
        $paramsBuilder = new ParamsBuilder();

        $this->assertFalse($paramsBuilder->has('bacon'));

        $paramsBuilder->add('bacon', 'delicious');

        $this->assertTrue($paramsBuilder->has('bacon'));
    }

    public function testRemove() {
        $paramsBuilder = new ParamsBuilder(['bacon' => 'delicious']);

        $this->assertTrue($paramsBuilder->has('bacon'));

        $paramsBuilder->remove('bacon');

        $this->assertFalse($paramsBuilder->has('bacon'));
    }

    public function testGet() {
        $paramsBuilder = new ParamsBuilder(['bacon' => 'delicious']);

        $this->assertEquals($paramsBuilder->get('bacon'), 'delicious');
        $this->assertNotEquals($paramsBuilder->get('bacon'), 'bad');
    }

    public function testBuild() {
        $paramsBuilder = new ParamsBuilder(['bacon' => 'delicious', 'mushrooms' => 'bad']);

        $this->assertEquals($paramsBuilder->build(), '?bacon=delicious&mushrooms=bad');
    }
}
