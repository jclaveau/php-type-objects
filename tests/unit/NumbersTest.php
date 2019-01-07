<?php
namespace JClaveau;
use JClaveau\Exceptions\NotANumberException;

class NumbersTest extends \PHPUnit_Framework_TestCase
{
    public function throwsExceptionIfNotANumber(callable $call, $exceptionClass)
    {
        foreach (['lala', null, [], (object)[]] as $value) {
            try {
                $call( $value );
                $this->assertTrue(false, "no exception occured when '$exceptionClass' expected");
            }
            catch (\Exception $e) {
                $this->assertInstanceOf($exceptionClass, $e);
            }
        }
    }
    
    /**
     */
    public function test_isInteger()
    {
        foreach ([0, 1, -1, -0] as $value) {
            $this->assertTrue( Numbers::isInteger($value) );
        }
        
        foreach ([0.0, 0.1, -0.1, NAN, INF] as $value) {
            $this->assertFalse( Numbers::isInteger($value) );
        }
        
        foreach (['lala', null, [], (object)[] ] as $value) {
            $this->assertFalse( Numbers::isInteger($value) );
        }
    }

    /**
     */
    public function test_isFloat()
    {
        foreach ([0, 1, -1, -0] as $value) {
            $this->assertFalse( Numbers::isFloat($value) );
        }
        
        foreach ([0.0, 0.1, -0.1, NAN, INF] as $value) {
            $this->assertTrue( Numbers::isFloat($value) );
        }
        
        foreach (['lala', null, [], (object)[] ] as $value) {
            $this->assertFalse( Numbers::isFloat($value) );
        }
    }

    /**
     */
    public function test_areEqual()
    {
        $integers         = [0, 1, -1, -0];
        $integersAsFloats = [0.0, 1.0, -1.0, -0.0];
        
        foreach ($integers as $i => $integer) {
            $this->assertTrue( Numbers::areEqual($integer, $integer) );
            $this->assertTrue( Numbers::areEqual($integer, $integersAsFloats[ $i ]) );
        }
        
        $floats = [-0.0, 0.0, 0.1, -0.1, INF, -INF];
        foreach ($floats as $i => $float) {
            $this->assertTrue( Numbers::areEqual($float, $float) );
        }

        // casts
        $this->assertFalse( Numbers::areEqual(0.1, 0) );
        $this->assertFalse( Numbers::areEqual(0.9, 0) );
        $this->assertFalse( Numbers::areEqual(1.3, 1) );
        $this->assertFalse( Numbers::areEqual(-0.1, 0) );
        $this->assertFalse( Numbers::areEqual(-0.9, 0) );
        $this->assertFalse( Numbers::areEqual(-1.3, -1) );

        $this->assertFalse( Numbers::areEqual(NAN, NAN) );

        $others = ['lala', null, [], (object)[] ];
        $this->throwsExceptionIfNotANumber(function($value) {
            Numbers::areEqual($value, 10);
            Numbers::areEqual(10, $value);
        }, NotANumberException::class);
    }

    /**/
}
