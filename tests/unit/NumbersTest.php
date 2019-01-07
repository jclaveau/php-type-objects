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

    /**
     */
    public function test_add()
    {
        $cases = [
            [0, 0, 0],
            [0.1, 1, 1.1],
            [-0.1, 0, -0.1],
            [-1, -1, -2],
            [INF, INF, INF],
            [-INF, -INF, -INF],
        ];
        
        foreach ($cases as $io) {
            $this->assertTrue( Numbers::add($io[0], $io[1]) == $io[2] );
        }
        
        $this->assertTrue( Numbers::isNan( Numbers::add(NAN, NAN) ) );

        foreach ($cases as $io) {
            $this->assertTrue( Numbers::isNan( Numbers::add(NAN, $io[0]) ) );
        }
    }

    /**
     */
    public function test_substract()
    {
        $cases = [
            [0, 0, 0],
            [0.1, 1, -0.9],
            [-0.1, 0, -0.1],
            [-1, -1, 0],
        ];
        
        foreach ($cases as $io) {
            $this->assertTrue( Numbers::substract($io[0], $io[1]) == $io[2] );
        }
        
        $this->assertTrue( Numbers::isNan( Numbers::substract(-INF, -INF) ) );
        $this->assertTrue( Numbers::isNan( Numbers::substract(INF, INF) ) );
        $this->assertTrue( Numbers::isNan( Numbers::substract(NAN, NAN) ) );

        foreach ($cases as $io) {
            $this->assertTrue( Numbers::isNan( Numbers::substract(NAN, $io[0]) ) );
        }
    }

    /**
     */
    public function test_multiply()
    {
        $cases = [
            [0, 0, 0],
            [0.1, 1, 0.1],
            [-0.1, 0, 0],
            [-1, -1, 1],
            [3, 4, 12],
            [INF, INF, INF],
            [-INF, INF, -INF],
            [-INF, -INF, INF],
        ];
        
        foreach ($cases as $io) {
            // var_dump($io);
            // var_dump(Numbers::multiply($io[0], $io[1]));
            $this->assertTrue( Numbers::multiply($io[0], $io[1]) == $io[2] );
        }
        
        $this->assertTrue( Numbers::isNan( Numbers::multiply(NAN, NAN) ) );

        foreach ($cases as $io) {
            $this->assertTrue( Numbers::isNan( Numbers::multiply(NAN, $io[0]) ) );
        }
    }

    /**
     */
    public function test_divide()
    {
        $cases = [
            [0.1, 1, 0.1],
            [-1, -1, 1],
            [3, 4, 0.75],
            [-3, 4, -0.75],
        ];
        
        foreach ($cases as $io) {
            $this->assertTrue( Numbers::divide($io[0], $io[1]) == $io[2] );
        }
        
        $this->assertTrue( Numbers::isNan( Numbers::divide(4, 0) ) );
        $this->assertTrue( Numbers::isNan( Numbers::divide(0, 0) ) );
        $this->assertTrue( Numbers::isNan( Numbers::divide(INF, INF) ) );
        $this->assertTrue( Numbers::isNan( Numbers::divide(INF, -INF) ) );
        $this->assertTrue( Numbers::isNan( Numbers::divide(-INF, -INF) ) );

        foreach ($cases as $io) {
            $this->assertTrue( Numbers::isNan( Numbers::divide(NAN, $io[0]) ) );
        }
    }

    /**
     */
    public function test_ceil()
    {
        $cases = [
            [0, 0],
            [0.1, 1],
            [-0.1, 0],
            [-1, -1],
            [INF, INF],
        ];
        
        foreach ($cases as $io) {
            $this->assertTrue( Numbers::ceil($io[0]) == $io[1] );
        }
        
        $this->assertTrue( Numbers::isNan( Numbers::ceil(NAN) ) );
    }

    /**/
}
