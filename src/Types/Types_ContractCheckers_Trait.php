<?php
namespace JClaveau\Types;

/**
 * + is countable
 * 
 * + is boolable
 * + is floatable
 * + is intable
 * + is numberable
 * + is stringable
 * + is arrayable
 */
trait Types_ContractCheckers_Trait
{
    protected static $typesAreNullable = true;
    
    /**
     * Checks if the value is a callable
     */
    public static function isNullable($value)
    {
        if (self::$typesAreNullable) {
            return true;
        }
        
        return $value instanceof Nullable;
    }
    
    /**
     * Checks if the value is boolifiable
     */
    public static function isBoolifiable($value)
    {
        return self::isBool($value) || $value instanceof Boolifiable;
    }
    
    /**
     * Checks if the value is intifiable
     */
    public static function isIntifiable($value)
    {
        return self::isInteger($value) || $value instanceof Intifiable;
    }
    
    /**
     * Checks if the value is floatifiable
     */
    public static function isFloatifiable($value)
    {
        return self::isFloat($value) || $value instanceof Floatifiable;
    }
    
    /**
     * Checks if the value is numberifiable
     */
    public static function isNumberifiable($value)
    {
        return self::isNumber($value) || $value instanceof Numberifiable;
    }
    
    /**
     * Checks if the value is stringifiable
     */
    public static function isStringifiable($value)
    {
        return self::isString($value) || $value instanceof Stringifiable;
    }
    
    /**
     * Checks if the value is arrayifiable
     */
    public static function isArrayifiable($value)
    {
        return self::isArray($value) || $value instanceof Arrayifiable;
    }
    
    /**
     * Checks if the value is objectifiable
     */
    public static function isObjectfiable($value)
    {
        return self::isArray($value) || $value instanceof Arrayifiable;
    }
    
    /**
     * Checks if the value is a callable
     */
    public static function isCallable($value)
    {
        return is_callable($value);
    }
    
} 
