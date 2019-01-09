<?php
namespace JClaveau;
use JCLaveau\Exceptions\NotANumberException;
use JCLaveau\Exceptions\NotStrictlyANumberException;
// Types
    // isEmpty()
    // isNotEmpty
    // isObjectOrClass()
    
    // isBoolifiable()
    // isNumberifiable()
    // isFloatifiable()
    // isIntifiable()
    // isStringifiable()
    // isArrayifiable()
    
    // isCountable()
    // isTraversable()
    
    // classExists()


abstract class Types
{
    protected static $noLoosyCast = true;
    protected static $comparisonIsStrict = true;
    
    /**
     * Checks if the value is Null
     */
    public static function isNull($value)
    {
        return $value === null;
    }
    
    /**
     * Checks if the value is a boolean
     */
    public static function isBool($value)
    {
        return is_bool($value);
    }
    
    /**
     * Checks if the value is an integer
     */
    public static function isInt($value)
    {
        return is_int($value);
    }
    
    /**
     * Checks if the value is a float
     */
    public static function isFloat($value)
    {
        return is_float($value);
    }
    
    /**
     * Checks if the value is a number
     */
    public static function isNumber($value)
    {
        return is_float($value) // includes INF
            || is_int($value) 
            // || $value instanceof Number ???
            ;
    }
    
    /**
     * Checks if the value is a string
     */
    public static function isString($value)
    {
        return is_string($value);
    }
    
    /**
     * Checks if the value is a scalar
     */
    public static function isScalar($value)
    {
        return is_scalar($value);
    }
    
    /**
     * Checks if the value is an array
     */
    public static function isArray($value)
    {
        return is_array($value);
    }
    
    /**
     * Checks if the value is an object
     */
    public static function isObject($value)
    {
        return is_object($value);
    }
    
    /**
     * Checks if the value is a callable
     */
    public static function isCallable($value)
    {
        return is_callable($value);
    }
    
    // Conversions
    
    /**
     */
    public static function toBool($value)
    {
        if (self::isBool($value)) {
            return $value;
        }
        
        if ($value instanceof Boolifiable) {
            return $value->toBool();
        }
        
        if (self::$comparisonIsStrict) {
            throw new NotABoolException();
            // throw new NotBoolifiableException(); ??
        }
        
        return (bool) $value;
    }
    
    /**
     */
    public static function toInt($value)
    {
        if (self::isInteger($value)) {
            return $value;
        }
        
        if ($value instanceof Numberifiable) {
            return $value->toInt();
        }
        
        if (self::isFloat($value) && ! Numbers::hasDecimalPart($value)) {
            return (int) $value;
        }
        
        if (self::$comparisonIsStrict) {
            throw new NotAnIntegerException();
            // throw new NotBoolifiableException(); ??
        }
        
        return (int) $value;
    }
    
    /**
     */
    public static function toFloat($value)
    {
        if (self::isFloat($value)) {
            return $value;
        }
        
        if ($value instanceof Numberifiable) {
            return $value->toFloat();
        }
        
        if (self::isInteger($value)) {
            return (float) $value;
        }
        
        if (self::$comparisonIsStrict) {
            throw new NotAnIntegerException();
            // throw new NotBoolifiableException(); ??
        }
        
        return (float) $value;
    }
    
    /**
     */
    public static function toNumber($value)
    {
        if (self::isNumber($value)) {
            return $value;
        }
        
        if ($value instanceof Numberifiable) {
            return $value->toNumber();
        }
        
        if (self::$comparisonIsStrict) {
            // throw new NotANumberException();
            throw new NotStrictlyANumberException();
            // throw new NotNumberifiableException(); ??
        }
        
        if (is_numeric($value)) {
            return (float) $value->toNumber();
        }
        
        if (self::$noLoosyCast) {
            throw new NotANumberException();
            // throw new NotNumberifiableException(); ??
        }
        
        return (float) $value;
    }
    
    
} 
