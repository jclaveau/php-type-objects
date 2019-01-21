<?php
namespace JClaveau\Contracts;

/**
 * Interface ensuring the instance which implements it can be converted
 * to a number value (int|float)
 */
interface Numberifiable
{
    public function toNativeNumber();
} 
