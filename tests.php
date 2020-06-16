<?php

include 'calculator.php';

//TESTING

foreach ($argv as $i => $arg) {
    if ($arg == "run") {
        runTests();
    }
}

function runTests()
{
    testOne();
    testTwo();
    testThree();
    testFour();
    testFive();
    testSix();
    testSeven();
    testEight();
    testNine();
    testTen();
    testEleven();
    testTwelve();
    testThirteen();
    testFourteen();
    testFifteen();
    testSixteen();
    testSeventeen();
}

/**
 * Testing empty input
 */
function testOne()
{
    echo "\n";
    $result = add('');

    if ($result == '') {
        echo 'Test one passed';
    } else {
        echo 'Test one failed';
    }
}

/**
 * Testing requirement #1
 */
function testTwo()
{
    echo "\n";
    $result = add('1,2,3');

    if ($result === 6) {
        echo 'Test two passed';
    } else {
        echo 'Test two failed';
    }
}

/**
 * Testing requirement #2
 */
function testThree()
{
    echo "\n";
    $result = add('1,2\n,3');

    if ($result === 6) {
        echo 'Test three passed';
    } else {
        echo 'Test three failed';
    }
}

/**
 * Testing requirement #3
 */
function testFour()
{
    echo "\n";
    $result = add('1,2,\n3');

    if ($result === 6) {
        echo 'Test four passed';
    } else {
        echo 'Test four failed';
    }
}

/**
 * Testing requirement #4
 */
function testFive()
{
    echo "\n";
    $result = add('//$\n1$2$3');

    if ($result === 6) {
        echo 'Test five passed';
    } else {
        echo 'Test five failed';
    }
}

/**
 * Testing requirement #4 - wrong input
 */
function testSix()
{
    echo "\n";
    $result = add('//$\n1$2;3');
    if ($result == '') {
        echo 'Test six passed';
    } else {
        echo 'Test six failed';
    }
}

/**
 * Testing requirement #4 - arbitary length
 */
function testSeven()
{
    echo "\n";
    $result = add('//$$$$$$\n1$$$$$$2$$$$$$3');

    if ($result === 6) {
        echo 'Test seven passed';
    } else {
        echo 'Test seven failed';
    }
}

/**
 * Testing requirement #4 - multiple delimiters
 */
function testEight()
{
    echo "\n";
    $result = add('//$,;,#\n1$2;3#4');

    if ($result === 10) {
        echo 'Test eight passed';
    } else {
        echo 'Test eight failed';
    }
}

/**
 * Testing bonus requirement - wrong extra delimiters
 */
function testNine()
{
    echo "\n";
    $result = add('//$$$$$$\n1$$;;$$2$$@$$3');

    if ($result === '') {
        echo 'Test nine passed';
    } else {
        echo 'Test nine failed';
    }
}

/**
 * Testing bonus requirement - negative input
 */
function testTen()
{
    echo "\n";
    try {
        add('//$$$$$$\n1$$$$$$2$$$$$$-3');
    } catch (Exception $e) {
        $result = $e->getMessage();
    }


    if ($result === 'Negatives not allowed -3') {
        echo 'Test ten passed';
    } else {
        echo 'Test ten failed';
    }
}

/**
 * Testing bonus requirement - over 1000
 */
function testEleven()
{
    echo "\n";

    $result = add('2,1001');
    if ($result === 2) {
        echo 'Test eleven passed';
    } else {
        echo 'Test eleven failed';
    }
}

/**
 * Testing bonus requirement - multiple delimiters with arbitary numbers
 */
function testTwelve()
{
    echo "\n";

    $result = add('//***,$$$$\n1***2$$$$4$$$$2$$$$6$$$$8');
    if ($result === 23) {
        echo 'Test twelve passed';
    } else {
        echo 'Test twelve failed';
    }
}

/**
 * Testing bonus requirement - multiple delimiters with arbitary numbers - wrong input case 1 (different delimiter count)
 */
function testThirteen()
{
    echo "\n";

    $result = add('//**,$$$$\n1***2$$$$4$$$$2$$$$6$$$$8');
    if ($result === '') {
        echo 'Test thirteen passed';
    } else {
        echo 'Test thirteen failed';
    }
}

/**
 * Testing multiple cases with correct format
 */
function testFourteen()
{
    echo "\n";

    $result = add('//***,$$$$,###\n1***2$$$$4$$$$2$$$$6$$$$8###2***5$$$$11###25');
    if ($result === 66) {
        echo 'Test forteen passed';
    } else {
        echo 'Test fourteen failed';
    }
}

/**
 * Testing multiple cases with wrong format
 */
function testFifteen()
{
    echo "\n";

    $result = add('//***,$$$$,###\n1***2$$$$4$$$$2$$$$6$$$8###2***5$$$$$11###25');
    if ($result === '') {
        echo 'Test fifteen passed';
    } else {
        echo 'Test fifteen failed';
    }
    echo "\n";
}

/**
 * Testing multiple cases with over 1000
 */
function testSixteen()
{
    echo "\n";

    $result = add('//***,$$$$,###\n1***2$$$$4$$$$2$$$$6$$$$8###2***5$$$$11###2500');
    if ($result === 41) {
        echo 'Test sixsteen passed';
    } else {
        echo 'Test sixsteen failed';
    }
    echo "\n";
}

/**
 * Testing multiple cases with multiple negatives
 */
function testSeventeen()
{
    echo "\n";
    try {
        add('//***,$$$$,###\n1***2$$$$4$$$$2$$$$6$$$$8###2***-5$$$$11###-20');
    } catch (Exception $e) {
        $result = $e->getMessage();
    }

    if ($result === 'Negatives not allowed -5,-20') {
        echo 'Test seventeen passed';
    } else {
        echo 'Test seventeen failed';
    }
    echo "\n";
}
