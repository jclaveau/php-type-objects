<?php
namespace JClaveau;
use JClaveau\Traits\Immutable;

abstract class Type
{
    use Immutable;
    
    protected $value;
    /**
     */
    protected final function __construct($value)
    {
        $this->value = $value;
    }

    abstract public static function new_($value, $options=[]);
} 
