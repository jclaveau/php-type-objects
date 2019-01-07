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

/**
 * Number
 */
class NumberInstance extends Type
{
    protected $nanable = true;
    protected $nanReason;
    
    /**
     * @todo $options mutable
     * @todo $options nanable
     */
    public static function new_($value, $options=[])
    {
        if ($value instanceof static) {
            return $value;
        }
        
        return new static(Types::toNumber($value));
    }

    /**
     * Checks if the value is integer
     */
    public function isInteger()
    {
        return Numbers::isInteger($this->value);
    }
    
    /**
     * Checks if the value is float
     */
    public function isFloat()
    {
        return Numbers::isFloat($this->value);
    }
    
    /**
     * Checks if the value is Nan
     */
    public function isNan()
    {
        return Numbers::isNan($this->value);
    }
    
    /**
     * Checks if the value is Nan
     */
    public function isInfinite()
    {
        return Numbers::isInfinite($this->value);
    }
    
    /**
     * Checks if the value is positive
     */
    public function isPositive()
    {
        return Numbers::isPositive($this->value);
    }
    
    /**
     * Checks if the value is negative
     */
    public function isNegative()
    {
        return Numbers::isNegative($this->value);
    }
    
    /**
     * Checks if the value is negative
     */
    public function isEqualTo($value)
    {
        return Numbers::areEqual($this->value, $value);
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
    public function ceil()
    {
        if ($this->callOnCloneIfImmutable($result))
            return $result;
        
        $this->value = Numbers::ceil($this->value);
        return $this;
    }
    
    /**
     */
    public function round()
    {
        if ($this->callOnCloneIfImmutable($result))
            return $result;
        
        return Numbers::round($this->value);
    }
    
    /**
     */
    public function floor()
    {
        if ($this->callOnCloneIfImmutable($result))
            return $result;
        
        return Numbers::floor($this->value);
    }
    
    /**
     */
    public function rand()
    {
        if ($this->callOnCloneIfImmutable($result))
            return $result;
        
        return Numbers::rand($this->value);
    }
    
    /**
     */
    public function pow($exp)
    {
        assert(Types::isNumber($exp));
        if ($this->callOnCloneIfImmutable($result))
            return $result;
        
        return Numbers::pow($this->value, $exp);
    }
    
    /**
     */
    public function sqrt()
    {
        if ($this->callOnCloneIfImmutable($result))
            return $result;
        
        return Numbers::sqrt($this->value);
    }
    
    /**/
} 
