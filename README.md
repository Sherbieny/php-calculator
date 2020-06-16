## PHP string Calculator
Simple calculator that parse strings and perform addition

#### Tools used
- VS code
- [Dillinger](https://dillinger.io/)

#### Features
- arithmetic addition
- string parsing
- test cases

#### Files
- calculator.php
- tests.php

#### Usage
* run `php calculator.php add {String containing symbols and numbers}`
* run `php tests.php run` to run all test cases
  * Note: negative numbers throws exception
  * Note: numbers over 1000 are ignored
  * Note: the string format should be one of the following (<b>use single quotes</b>)
    * `1,2,5` comma separated numbers
    * `1\n,2,3` comma separated with \n after a number
    * `1,\n2,4` comma separated with \n before a number
    * `//[delimiter]\n[delimiter separated numbers]` general format
      * `//;\n1;3;4` example with one delimiter
      * `//@\n2@3@8` example with one delimiter 
      * `//***\n1***2***3`example with one delimiter with arbitary length
      * `//$,@\n1$2@3` example with multiple delimiters
      * `'//**,$$$$\n1***2$$$$4$$$$2$$$$6'` example with multiple delimiters and arbitary length
