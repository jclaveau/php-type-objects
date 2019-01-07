+ chaque objet doit avoir une fonction de création (factory fonctionnel)
+ Toute methode d'objet existe sous une forme statique d'une classe abstraite au pluriel
+ Chaque classe abstraite a son équivalent au singulier instanciable
+ Toute methode statique existe en fonctionnel (et appelle la statique)
+ 

<?php

function foo($param, $string) {
    assert(Strings::isRegex($param), "\$param MUST be a regex");
    assert(Types::isString($string), "\$param MUST be a string");
    
    // return Regex::construct($param)
    return Regex($param)
        ->match($string)
        ->getParts()[1]
        ;
    
}


?>

Types
    isScalar()
    isBool()
    isNumber()
    isFloat()
    isInt()
    isString()
    isArray()
    isObject()
    isCallable()
    isEmpty()
    isNotEmpty
    isNull
    isNotNull
    isObjectOrClass()
    
    isBoolifiable()
    isNumberifiable()
    isFloatifiable()
    isIntifiable()
    isStringifiable()
    isArrayifiable()
    
    isCountable()
    isTraversable()
    
    classExists()


Arrays
    keyExists()
    keyIsset()
    keyNotExists()
    maxIs()
    minIs()
    notContains
    contains
    map
    keyFirst
    keyLast
    keys
    https://secure.php.net/manual/fr/book.array.php
Array_


Numbers
    isInteger()
    isFloat()
    isNan()
    isFinite()
    isInfinite()
    isMoreThan()
    isMoreOrEqualThan()
    isLessThan()
    isLessOrEqualThan()
    isResource()
    isPositive()
    isNegative()
    ceil()
    round()
    floor()
    format()
    add()
    sub()
    div()
    times()
    pow()
    sqrt()
    rand()
    cos()
    sin()
    tan()
    https://secure.php.net/manual/fr/ref.math.php
Number


Strings
    isEmail()
    isIp()
    isIpV4()
    isIpV6()
    isJsonString()
    isRegex()
    isNotRegex()
    isSubClassOf()
    isUrl()
    isUuid()
    isFile()
    isDirectory()
    isDate()
    classExists()
String_

Bools
    isFalse
    isTrue

Objects
    isCountable
    isInstanceOf
    isTraversable
    methodExists
    propertyExists
    propertiesExists
