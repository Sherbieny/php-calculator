<?php

foreach ($argv as $i => $arg) {
    if ($arg == "add") {
        if (isset($argv[$i + 1])) {
            add($argv[$i + 1]);
        }
    }
}


function add(string $input)
{
    //handle bad cases
    if (empty($input)) return "";
    if (!is_string($input)) return "";

    //get the delimiters if they exists    
    $delimiters = getDelimiter($input, "//", "\\n");

    // echo $delimiters;
    if (strlen($delimiters) > 1) {
        //get them into an array
        $delimiters = str_split($delimiters);
        //get count of each delimiter
        $delimiters = array_count_values($delimiters);
        //remove , from symbols        
        if (isset($delimiters[','])) unset($delimiters[',']);
    } elseif (strlen($delimiters) == 1) {
        $delimter = $delimiters[0];
        $delimiters = [];
        $delimiters = [$delimter => 1];
    }

    $numbers = getNumbers($input, $delimiters);

    if (empty($numbers)) return "";

    $sum = array_sum($numbers);
    echo $sum;
    echo "\n";

    return $sum;
}

function getNumbers($input, $delimiters)
{
    $numbers = [];
    if (is_array($delimiters)) {
        $numIndex = strpos($input, "\\n");
        if ($numIndex === false) return [];

        //Get numbers in an array
        $numString = substr($input, $numIndex + 2); //get string after \n
        $numbers = preg_split('/[^\d-]+/', $numString); // strip non numeric chars exluding minus        
        //$numbers = str_split($numbers); 
        $existingPatterns = preg_split("/[\d-]+/", $numString); // all the patterns existing in the number string (correct and wrong) excluding minus symbol               

        //get symbols to check if non existing delimiters exists
        $symbols = str_split(preg_replace('/[\d-]+/', '', $numString));
        //check to see if all delimiters are used in pattern
        foreach ($delimiters as $delimiter => $delimiterCount) {
            //check if a delimiter does not exist
            if (strpos($numString, $delimiter) === false) {
                //if pattern is wrong return empty                           
                return [];
            }
            //Check if delimiter count matches pattern - in case of arbitary length
            // example //**$$\n1**2$$3
            // in the example above, it is expected that * delimiter should be ** in every occurence in the number string if * or *** for example exists, it will fail            
            if ($delimiterCount > 1) {
                foreach ($existingPatterns as $existingPattern) {
                    if (strlen($existingPattern) == 0) continue; // to ignore empty strings
                    //check if its the right symbol
                    if (strpos($existingPattern, $delimiter) === false) continue; // to ignore different patterns

                    //check if the pattern count matches the delimiter count - if not exit
                    if (strlen($existingPattern) != $delimiterCount) {
                        return [];
                    }
                }
            }
        }

        foreach ($symbols as $symbol) {
            //check for non existing delimiter
            if (!isset($delimiters[$symbol])) {
                //if a symbol is there and not in delimiters return empty                   
                return [];
            }
        }
    } else {
        $numbers = explode(',', $input);
        foreach ($numbers as $index => $number) {
            if (strpos($number, "\\n") !== false) {
                $numbers[$index] = preg_replace('/[^\d]+/', '', $number);
            }
        }
    }

    $negatives = [];
    foreach ($numbers as $index => $number) {
        //Check for 1000+ numbers
        if ((int) $number > 1000) {
            unset($numbers[$index]);
        }
        //Check for negatives        
        if ((int) $number < 0) {
            array_push($negatives, $number);
        }
    }

    if (!empty($negatives)) {
        throw new Exception("Negatives not allowed " . implode(',', $negatives));
    }

    //var_dump($numbers);
    return $numbers;
}

function getDelimiter($str, $starting_word, $ending_word)
{
    //confirm delimiter start and end exists    
    if (strpos($str, "\\n") === false) return '';
    if (strpos($str, "//") === false) return '';

    $arr = explode($starting_word, $str);
    if (isset($arr[1])) {
        $arr = explode($ending_word, $arr[1]);
        return $arr[0];
    }
    return '';
}
