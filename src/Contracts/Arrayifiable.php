<?php
namespace JClaveau\Types;

/**
 * Interface ensuring the instance which implements it can be converted
 * to an array
 */
interface Arrayifiable
{
    public function toArray();
} 
