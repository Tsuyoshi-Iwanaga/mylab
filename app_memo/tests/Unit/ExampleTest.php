<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    //データ型のチェック
    public function testassertType()
    {
        $this->assertIsString('hoge');
        $this->assertIsBool(true);
        $this->assertIsInt(5);
        $this->assertIsFloat(1.5);
        $this->assertIsArray([]);
        $this->assertIsScalar('hoge');
        $this->assertIsNumeric(10);
        $this->assertIsNumeric('10');
        // $this->assertIsObject()
        // $this->assertResource()
        $this->assertIsIterable([]);
        $this->assertIsCallable(function() {});
        $this->assertNull(null);
        $this->assertNAN(NAN);
        $this->assertEmpty('');
        $this->assertEmpty([]);
        $this->assertEmpty(0);
        $this->assertEmpty('0');
        $this->assertInfinite(INF);
        $this->assertTrue(true);
        $this->assertFalse(false);
        $this->assertGreaterThan(1, 2);
        $this->assertGreaterThanOrEqual(1, 1);
        $this->assertLessThan(1, 0);
        $this->assertLessThanOrEqual(1, 1);
        $this->assertRegExp('/\d{4}/', '2020年');
        $this->assertStringMatchesFormat('%d', '5');
        // $this->assertStringMatchesFormatFile()
    }
}
