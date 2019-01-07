<?php
namespace JClaveau;
use JClaveau\Traits\Immutable;

abstract class Type
{
    use Immutable;
    
    private $value;
    
    /**
     */
    protected final function __construct($value)
    {
        $this->value = $value;
    }

    abstract public static function new_($value, $options=[]);
    
    public function getValue()
    {
        return $this->value;
    }
    
    protected function setValue($value)
    {
        return $this->value = $value;
    }
} 
