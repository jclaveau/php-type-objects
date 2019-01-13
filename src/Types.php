<?php
namespace JClaveau;
use JCLaveau\Exceptions\NotANumberException;
use JCLaveau\Exceptions\NotStrictlyANumberException;
// Types
    // isEmpty()
    // isNotEmpty
    // isObjectOrClass()
    
    // isBoolifiable()
    // isNumberifiable()
    // isFloatifiable()
    // isIntifiable()
    // isStringifiable()
    // isArrayifiable()
    
    // isCountable()
    // isTraversable()
    
    // classExists()

require_once __DIR__ . '/Types/Types_TypeCheckers_Trait.php';
require_once __DIR__ . '/Types/Types_Casts_Trait.php';
require_once __DIR__ . '/Types/Types_ContractCheckers_Trait.php';

/**
 * This class provides helpers for type checking.
 */
abstract class Types
{
    use Types\Types_TypeCheckers_Trait;
    use Types\Types_Casts_Trait;
    use Types\Types_ContractCheckers_Trait;
} 
