<?php
namespace JClaveau\Types;

/**
 * Interface ensuring the instance which implements it can be converted
 * to a float value
 */
interface Floatifiable
{
    public function toFloat();
} 
