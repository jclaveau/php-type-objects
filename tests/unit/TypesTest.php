<?php
namespace JClaveau;
use JClaveau\Exceptions\NotANumberException;

class TypesTest extends \PHPUnit_Framework_TestCase
{
    public function throwsExceptionIfNotANumber(callable $call, $exceptionClass)
    {
        foreach (['lala', [], (object)[]] as $value) {
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
    public function test_isNull()
    {
        foreach ([0, 1, -1, -0, 0.0, 0.1, -0.1, INF, NAN, 'lala', [], (object)[], true, false] as $value) {
            $this->assertFalse( Types::isNull($value), var_export($value, true). " is Null" );
        }
        
        $this->assertTrue( Types::isNull(null), "null is not null" );
    }
    
    /**
     */
    public function test_isBool()
    {
        foreach ([0, 1, -1, -0, 0.0, 0.1, -0.1, INF, NAN, 'lala', [], (object)[]] as $value) {
            $this->assertFalse( Types::isBool($value), var_export($value, true). " is a bool" );
        }
        
        $this->assertTrue( Types::isBool(true), "true is not a bool" );
        $this->assertTrue( Types::isBool(false), "true is not a bool" );
    }
    
    /**
     */
    public function test_isInteger()
    {
        foreach ([0, 1, -1, -0] as $value) {
            $this->assertTrue( Types::isInteger($value) );
        }
        
        foreach ([0.0, 0.1, -0.1, NAN, INF, true, false, 'lala', null, [], (object)[]] as $value) {
            $this->assertFalse( Types::isInteger($value) );
        }
    }

    /**
     */
    public function test_isFloat()
    {
        foreach ([0, 1, -1, -0, true, false, 'lala', null, [], (object)[]] as $value) {
            $this->assertFalse( Types::isFloat($value) );
        }
        
        foreach ([0.0, 0.1, -0.1, NAN, INF] as $value) {
            $this->assertTrue( Types::isFloat($value) );
        }
    }

    /**
     */
    public function test_isNan()
    {
        foreach ([0, 1, -1, -0, 0.0, 0.1, -0.1, INF, true, false, 'lala', null, [], (object)[] ] as $value) {
            $this->assertFalse( Types::isNan($value) );
        }
        
        $this->assertTrue( Types::isNan( NAN ) );
    }

    /**
     */
    public function test_isNumber()
    {
        foreach ([0, 1, -1, -0, 0.0, 0.1, -0.1, INF, NAN] as $value) {
            $this->assertTrue( Types::isNumber($value), var_export($value, true). " is a number" );
        }
        
        foreach (['lala', null, [], (object)[], true, false] as $value) {
            $this->assertFalse( Types::isNumber($value), var_export($value, true). " is not a number" );
        }
    }

    /**
     */
    public function test_isString()
    {
        foreach (['lala', ''] as $value) {
            $this->assertTrue( Types::isString($value), var_export($value, true). " is a string" );
        }
        
        foreach ([0, 1, -1, -0, 0.0, 0.1, -0.1, INF, NAN, null, [], (object)[], true, false] as $value) {
            $this->assertFalse( Types::isString($value), var_export($value, true). " is not a string" );
        }
    }

    /**
     */
    public function test_isScalar()
    {
        foreach (['lala', '', 0, 1, -1, -0, 0.0, 0.1, -0.1, INF, NAN, true, false] as $value) {
            $this->assertTrue( Types::isScalar($value), var_export($value, true). " is a scalar" );
        }
        
        foreach ([[], (object)[], null] as $value) {
            $this->assertFalse( Types::isScalar($value), var_export($value, true). " is not a scalar" );
        }
    }

    /**
     */
    public function test_isArray()
    {
        foreach (['lala', '', 0, 1, -1, -0, 0.0, 0.1, -0.1, INF, NAN, true, false, null, (object)[]] as $value) {
            $this->assertFalse( Types::isArray($value), var_export($value, true). " is an array" );
        }
        
        $this->assertTrue( Types::isArray([]), "[] is an array" );
    }

    /**
     */
    public function test_isObject()
    {
        foreach (['lala', '', 0, 1, -1, -0, 0.0, 0.1, -0.1, INF, NAN, true, false, null, []] as $value) {
            $this->assertFalse( Types::isObject($value), var_export($value, true). " is an object" );
        }
        
        $this->assertTrue( Types::isObject( (object)[] ), "[] is an object");
    }

    /**
     */
    public function test_isResource()
    {
        foreach (['lala', '', 0, 1, -1, -0, 0.0, 0.1, -0.1, INF, NAN, true, false, null, [], (object)[]] as $value) {
            $this->assertFalse( Types::isResource($value), var_export($value, true). " is a resource" );
        }
        
        $this->assertTrue( Types::isResource( $resource = fopen(__FILE__, 'r') ), __FILE__ . " is a resource");
        
        fclose($resource);
    }

    /**/
}
