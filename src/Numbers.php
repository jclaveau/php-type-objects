<?php
namespace JClaveau;

use JClaveau\Exceptions\NotANumberException;

// Numbers
    // isMoreThan()
    // isMoreOrEqualThan()
    // isLessThan()
    // isLessOrEqualThan()
    // isResource()
    
    // format()
    
    // https://secure.php.net/manual/fr/ref.math.php
// Number


abstract class Numbers
{
    /**
     * @return int|float
     */
    public static function getNativeNumber($value)
    {
        if (Types::isNumber($value)) {
            return $value;
        }
        elseif($value instanceof Number) {
            return $value->getValue();
        }
        else {
            throw new NotANumberException();
        }
    }

    /**
     * Checks if the value is integer
     */
    public static function isInteger($value)
    {
        try {
            return Types::isInt( static::getNativeNumber($value) );
        }
        catch (NotANumberException $a) {
            return false;
        }
    }
    
    /**
     * Checks if the value is float
     */
    public static function isFloat($value)
    {
        try {
            return Types::isFloat( static::getNativeNumber($value) );
        }
        catch (NotANumberException $a) {
            return false;
        }
    }
    
    /**
     * Checks if the value is Nan
     */
    public static function isNan($value)
    {
        return is_nan($value);
    }
    
    /**
     * Checks if the value is Nan
     */
    public static function isInfinite($value)
    {
        return is_infinite($value);
    }
    
    
    /**
     * Checks if the value is Nan
     */
    public static function isPositive($value)
    {
        return static::getNativeNumber($value) >= 0;
    }
    
    /**
     * Checks if the value is Nan
     */
    public static function isNegative($value)
    {
        return static::getNativeNumber($value) < 0;
    }
    
    /**
     * Checks if the value is a float with a non null decimal part.
     * This allaws to know if a float can be casted as an int.
     */
    public static function hasDecimalPart($value)
    {
        $value = static::getNativeNumber($value);
        return floor($value) != $value;
    }
    
    /**
     * Allows only non lossly casts between ints and floats
     */
    public static function areEqual($value1, $value2)
    {
        $value1 = static::getNativeNumber($value1);
        $value2 = static::getNativeNumber($value2);
        
        return $value1 == $value2;
    }
    
    
    // MATHS https://secure.php.net/manual/fr/ref.math.php
    // ceil()
    // round()
    // floor()
    // add()
    // sub()
    // div()
    // times()
    // pow()
    // sqrt()
    // rand()
    // cos()
    // sin()
    // tan()
    
    /**
     */
    public static function ceil($value)
    {
        return ceil( static::getNativeNumber($value) );
    }
    
    /**
     */
    public static function round($value)
    {
        return round( static::getNativeNumber($value) );
    }
    
    /**
     */
    public static function floor($value)
    {
        return floor( static::getNativeNumber($value) );
    }
    
    /**
     */
    public static function rand($value)
    {
        return rand( static::getNativeNumber($value) );
    }
    
    /**
     */
    public static function pow($value, $exp)
    {
        return pow( static::getNativeNumber($value), static::getNativeNumber($exp) );
    }
    
    /**
     */
    public static function sqrt($value)
    {
        return sqrt( static::getNativeNumber($value) );
    }
    
} 
