<?php
namespace JClaveau\Types;

/**
 * Interface ensuring the instance which implements it can be converted
 * to an integer value
 */
interface Intifiable
{
    public function toInteger();
} 
