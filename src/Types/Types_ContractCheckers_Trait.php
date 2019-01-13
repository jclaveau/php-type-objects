<?php
namespace JClaveau\Types;

use JCLaveau\Exceptions\NotANumberException;
use JCLaveau\Exceptions\NotStrictlyANumberException;

/**
 */
trait Types_ContractCheckers_Trait
{
    protected static $typesAreNullable = true;
    
    /**
     * Checks if the value is a callable
     */
    public static function isCallable($value)
    {
        return is_callable($value);
    }
    
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
    
} 
