<?php
namespace JClaveau\Types;

/**
 * Interface ensuring the instance which implements it can be converted
 * to null
 */
interface Nullable
{
    public function toNull();
} 
