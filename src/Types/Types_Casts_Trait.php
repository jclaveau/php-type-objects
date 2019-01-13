<?php
namespace JClaveau\Types;

use JCLaveau\Exceptions\NotANumberException;
use JCLaveau\Exceptions\NotStrictlyANumberException;

/**
 */
trait Types_Casts_Trait
{
    protected static $noLoosyCast = true;
    protected static $comparisonIsStrict = true;
    
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
            throw new NotBoolifiableException();
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
        
        if ($value instanceof Intifiable) {
            return $value->toInt();
        }
        
        if (self::isFloat($value) && ! Numbers::hasDecimalPart($value)) {
            // 1.0 can be converted to 1 safely
            return (int) $value;
        }
        
        if (self::$comparisonIsStrict) {
            throw new NotIntifiableException();
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
        
        if ($value instanceof Floatifiable) {
            return $value->toFloat();
        }
        
        if (self::isInteger($value)) {
            return (float) $value;
        }
        
        if (self::$comparisonIsStrict) {
            throw new NotFloatifiableException();
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
    
    /**/
} 
