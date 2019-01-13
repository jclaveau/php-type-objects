<?php
namespace JClaveau\Types;

/**
 * This trait provides helpers for type checking.
 * + Native checks are strict
 * + Type checks MUST never throw exception
 * + isNumber() gathers Integers and Floats (INF and NAN also)
 */
trait Types_TypeCheckers_Trait
{
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
    public static function isInteger($value)
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
     * Checks if the value is a number
     */
    public static function isNan($value)
    {
        if (! static::isFloat($value)) {
            // Avoids: is_nan() expects parameter 1 to be double, array given
            return false;
        }

        return is_nan($value);
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
     * Checks if the value is a resource
     */
    public static function isResource($value)
    {
        return is_resource($value);
    }

    /**/
}
