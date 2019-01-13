<?php
namespace JClaveau\Types;

/**
 * Interface ensuring the instance which implements it can be converted
 * to an object
 */
interface Objectifiable
{
    public function toObject();
} 
