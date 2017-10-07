<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\App;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TestDataClassTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSet()
    {
        $object = App::make('TestDataClass');
        $object->set('prop1','val1');
        $object->faker('prop2')->uuid;
        $object->faker('prop3')->randomNumber();
    }

    public function testGet()
    {
        $object = App::make('TestDataClass');
        $this->assertEquals($object->get('prop1'), 'val1');
        $this->assertInternalType('string', $object->get('prop2'));
        $this->assertInternalType('integer', $object->get('prop3'));
    }

    public function testRefresh()
    {
        $object = App::make('TestDataClass');
        $prop11 = $object->get('prop1');
        $prop12 = $object->get('prop2');
        $prop13 = $object->get('prop3');

        $object->refresh();

        $prop21 = $object->get('prop1');
        $prop22 = $object->get('prop2');
        $prop23 = $object->get('prop3');

        $this->assertEquals($prop11, $prop21);
        $this->assertFalse($prop12 == $prop22);
        $this->assertFalse($prop13 == $prop23);

    }

    public function testFresh()
    {
        $object = App::make('TestDataClass');
        $this->assertNotNull($object->get('prop1'));
        $this->assertNotNull($object->get('prop2'));
        $this->assertNotNull($object->get('prop3'));

        $object->fresh();

        $this->assertNull($object->get('prop1'));
        $this->assertNull($object->get('prop2'));
        $this->assertNull($object->get('prop3'));
    }
}
