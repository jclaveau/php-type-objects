<?php
namespace JClaveau\Types;

/**
 * Interface ensuring the instance which implements it can be converted
 * to a string value
 */
interface Stringifiable
{
    public function toString();
} 
