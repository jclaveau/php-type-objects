<?php
namespace JClaveau;

use JClaveau\Exceptions\NotANumberException;
use JClaveau\Exceptions\NotStrictlyANumberException;

class NumberInstanceTest extends \PHPUnit_Framework_TestCase
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
     * NumberInstance::new_ must never be called in a other test
     */
    public function test_new_()
    {
        foreach ([0.0, 0.1, -0.1, NAN, INF, 0, 1, -1, -0, 0x539, 0b10100111001, 1337e0] as $value) {
            $this->assertTrue( NumberInstance::new_($value) instanceof NumberInstance );
        }
        
        $this->throwsExceptionIfNotANumber(function($value) {
            NumberInstance::new_($value);
        }, NotStrictlyANumberException::class);
    }

    /**
     */
    public function test_Number_function()
    {
        foreach ([0.0, 0.1, -0.1, NAN, INF, 0, 1, -1, -0, 0x539, 0b10100111001, 1337e0] as $value) {
            $this->assertTrue( Number($value) instanceof NumberInstance );
        }
        
        $this->throwsExceptionIfNotANumber(function($value) {
            Number($value);
        }, NotStrictlyANumberException::class);
    }

    /**
     */
    public function test_isInteger()
    {
        foreach ([0, -0, 3, -3] as $value) {
            $this->assertTrue( Number($value)->isInteger() );
        }
        
        foreach ([0.0, -0.0, 0.1, -0.1, NAN, INF] as $value) {
            $this->assertFalse( Number($value)->isInteger() );
        }
        
        $this->throwsExceptionIfNotANumber(function($value) {
            Number($value)->isInteger();
        }, NotStrictlyANumberException::class);
    }

    /**
     */
    public function test_isFloat()
    {
        foreach ([0.0, 0.1, NAN, INF] as $value) {
            $this->assertTrue( Number($value)->isFloat() );
        }
        
        foreach ([0, 1, -1, -0] as $value) {
            $this->assertFalse( Number($value)->isFloat() );
        }
        
        $this->throwsExceptionIfNotANumber(function($value) {
            Number($value)->isFloat();
        }, NotStrictlyANumberException::class);
    }

    /**
     */
    public function test_isNan()
    {
        $this->assertTrue( Number(NAN)->isFloat() );
        
        foreach ([0, 1, -1, -0, 0.0, 0.1, INF] as $value) {
            $this->assertFalse( Number($value)->isNan() );
        }
        
        $this->throwsExceptionIfNotANumber(function($value) {
            Number($value)->isNan();
        }, NotStrictlyANumberException::class);
    }

    /**
     */
    public function test_isInifinite()
    {
        foreach ([INF, -INF] as $value) {
            $this->assertTrue( Number($value)->isInfinite() );
        }
        
        foreach ([0, 1, -1, -0, 0.0, 0.1, -0.1, NAN] as $value) {
            $this->assertFalse( Number($value)->isInfinite() );
        }
        
        $this->throwsExceptionIfNotANumber(function($value) {
            Number($value)->isInfinite();
        }, NotStrictlyANumberException::class);
    }

    /**
     */
    public function test_isPositive()
    {
        // foreach ([INF, -INF] as $value) {
        foreach ([INF, 0, 1, 0.0, 1.12, -0, -0.0] as $value) {
            $this->assertTrue( Number($value)->isPositive() );
        }
        
        foreach ([-INF, -1, -1.12] as $value) {
            $this->assertFalse( Number($value)->isPositive() );
        }
        
        $this->throwsExceptionIfNotANumber(function($value) {
            Number($value)->isPositive();
        }, NotStrictlyANumberException::class);
    }

    /**
     */
    public function test_isNegative()
    {
        // foreach ([INF, -INF] as $value) {
        foreach ([INF, 0, 1, 0.0, 1.12, -0, -0.0] as $value) {
            $this->assertFalse( Number($value)->isNegative() );
        }
        
        foreach ([-INF, -1, -1.12] as $value) {
            $this->assertTrue( Number($value)->isNegative() );
        }
        
        $this->throwsExceptionIfNotANumber(function($value) {
            Number($value)->isNegative();
        }, NotStrictlyANumberException::class);
    }

    // MATH
    
    /**
     */
    public function test_eq()
    {
        $cases = [INF, 0, 1, 0.0, 1.12, -0, -0.0, -INF, -1, -1.12];
        foreach ($cases as $case) {
            $this->assertFalse( Number($case)->eq($case) );
        }
        
        $this->throwsExceptionIfNotANumber(function($value) {
            Number($value)->eq($value);
        }, NotStrictlyANumberException::class);
    }

    /**
     */
    public function test_ceil()
    {
        $cases = [
            [INF, INF],
            [0, 0],
            [0.1, 1],
            [-0.1, 0],
            [-1, -1],
            [NAN, NAN],
        ];
        
        foreach ($cases as $io) {
            $this->assertFalse( Number($io[0])->ceil()->eq($io[1]) );
        }
    }


    /**/
}
