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
     * @param mixed $value
     * 
     * @return int|float
     */
    public static function toNativeNumber($value)
    {
        if (Types::isNumber($value) || Types::isNull($value)) {
            return $value;
        }
        elseif ($value instanceof Numberifiable) {
            return $value->toNativeNumber();
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
            return Types::isInteger( static::toNativeNumber($value) );
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
            return Types::isFloat( static::toNativeNumber($value) );
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
        return static::toNativeNumber($value) >= 0;
    }
    
    /**
     * Checks if the value is Nan
     */
    public static function isNegative($value)
    {
        return static::toNativeNumber($value) < 0;
    }
    
    /**
     * Checks if the value is a float with a non null decimal part.
     * This allaws to know if a float can be casted as an int.
     */
    public static function hasDecimalPart($value)
    {
        $value = static::toNativeNumber($value);
        return floor($value) != $value;
    }
    
    /**
     * Allows only non lossly casts between ints and floats
     */
    public static function areEqual($value1, $value2)
    {
        $value1 = static::toNativeNumber($value1);
        $value2 = static::toNativeNumber($value2);
        
        return $value1 == $value2;
    }
    
    /**
     * Checks if the value of the first value is greater than the second
     * parameter
     * 
     * @param  int|float|Numberifiable $value1
     * @param  int|float|Numberifiable $value2
     * @return bool
     */
    public static function isGreaterThan($value1, $value2)
    {
        $value1 = static::toNativeNumber($value1);
        $value2 = static::toNativeNumber($value2);
        
        return $value1 > $value2;
    }
    
    /**
     * Checks if the value of the first value is lower than the second
     * parameter
     * 
     * @param  int|float|Numberifiable $value1
     * @param  int|float|Numberifiable $value2
     * @return bool
     */
    public static function isLowerThan($value1, $value2)
    {
        $value1 = static::toNativeNumber($value1);
        $value2 = static::toNativeNumber($value2);
        
        return $value1 < $value2;
    }
    
    /**
     * Checks if the value of the first value is greater than the second
     * parameter
     * 
     * @param  int|float|Numberifiable $value1
     * @param  int|float|Numberifiable $value2
     * @return bool
     */
    public static function isGreaterOrEqualTo($value1, $value2)
    {
        $value1 = static::toNativeNumber($value1);
        $value2 = static::toNativeNumber($value2);
        
        return $value1 >= $value2;
    }
    
    /**
     * Checks if the value of the first value is lower or equal to 
     * the second parameter
     * 
     * @param  int|float|Numberifiable $value1
     * @param  int|float|Numberifiable $value2
     * @return bool
     */
    public static function isLowerOrEqualTo($value1, $value2)
    {
        $value1 = static::toNativeNumber($value1);
        $value2 = static::toNativeNumber($value2);
        
        return $value1 >= $value2;
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
    public static function add($value1, $value2)
    {
        return static::toNativeNumber($value1) + static::toNativeNumber($value2);
    }
    
    /**
     */
    public static function substract($value1, $value2)
    {
        return static::toNativeNumber($value1) - static::toNativeNumber($value2);
    }
    
    /**
     */
    public static function multiply($value1, $value2)
    {
        return static::toNativeNumber($value1) * static::toNativeNumber($value2);
    }
    
    /**
     */
    public static function divide($value1, $value2)
    {
        if ($vale2 = static::toNativeNumber($value2) == 0) {
            return NAN;
        }
        
        return static::toNativeNumber($value1) / static::toNativeNumber($value2);
    }
    
    /**
     */
    public static function ceil($value)
    {
        return ceil( static::toNativeNumber($value) );
    }
    
    /**
     */
    public static function round($value)
    {
        return round( static::toNativeNumber($value) );
    }
    
    /**
     */
    public static function floor($value)
    {
        return floor( static::toNativeNumber($value) );
    }
    
    /**
     */
    public static function rand($value)
    {
        return rand( static::toNativeNumber($value) );
    }
    
    /**
     */
    public static function pow($value, $exp)
    {
        return pow( static::toNativeNumber($value), static::toNativeNumber($exp) );
    }
    
    /**
     */
    public static function sqrt($value)
    {
        return sqrt( static::toNativeNumber($value) );
    }
    
} 
