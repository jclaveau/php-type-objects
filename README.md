# WIP: php-types
Helpers and classes for types


# Guidelines
+ Native types are partial projections of more abstract types
+ Seek for an abstraction following intuition (ints and floats are numbers, string is an array of chars, ...)
+ Provide a way to control strictness of castings
+ Provide contracts (Interfaces and traits) to allow comparisons
+ Avoid useless fatal errors (e.g. is_nan on a non scalar)

## Related 
https://github.com/nikic/scalar_objects
