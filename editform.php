<?php
/*problems: glocal variable scope; function return true/false; regular expression format; css float*/
/*handle the information of form checking on index.php*/

$nameErr = $colorErr = $countErr = $meaningErr = $addsubmitInfo = "";
$name = $color = $count = $meaning = "";
$nameCheck = $colorCheck = $countCheck = $meaningCheck = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {       
  $nameCheck = name_check($_POST["name"]); //check name
  $colorCheck = color_check($_POST["color"]); //check color   
  $countCheck = number_check($_POST["count"]); //check number
  $meaningCheck = meaning_check($_POST["meaning"]); //check meaning   
  if ((!empty($_POST["addsubmit"])) && $nameCheck === true && $colorCheck === true && $countCheck === true && $meaningCheck === true) {
     $addsubmitInfo = "Add successfully!";
  } else {
     $addsubmitInfo = "Try again!";
  }
}

/* Name must be set and should only consist of characters, spaces or numbers, and cannot be only spaces*/
function name_check($input) {
  $check = true;
  if (empty($input)) {
     $GLOBALS['nameErr'] = "Give a name to your language of roses!";
     $check = false;
  } else {
    $GLOBALS['name'] = input_process($input);
    if (!preg_match("/^[a-zA-Z0-9 ]+$/", $GLOBALS['name']) || strlen($GLOBALS['name']) == 0) { 
      $GLOBALS['nameErr']  = "Name should only consist of characters, spaces or numbers, and cannot be only spaces!";
      $check = false;
    }
  }
  return $check;
}

/* Color must be chosen*/
function color_check($input) {
  $check = true;
  if (empty($input) || $input == "blank") {
     $GLOBALS['colorErr']  = "What color do you like?";
     $check = false;
  } 
  $GLOBALS['color'] = input_process($input);
  return $check;     
}

/* Number must be chosen and bigger than 0*/
function number_check($input) {
  $check = true;
  if (empty($input)) {
     $GLOBALS['countErr'] = "Input a count!";
     $check = false;
  } else {
     $GLOBALS['count'] = input_process($input);
     if($GLOBALS['count'] <= 0) {
        $GLOBALS['countErr'] = "The count should be bigger than 0!";
        $check = false;
     }
   }
  return $check;
}

/* Must input meaning and no longer than 200 characters, cannot all be spaces*/
function meaning_check($input) {
  $check = true;
  if (empty($input)) {
     $GLOBALS['meaningErr'] = "What is the meaning of the language?";
     $check = false;
   } else {
     $GLOBALS['meaning'] = input_process($input);
     if (strlen($GLOBALS['meaning']) > 200 || strlen($GLOBALS['meaning']) == 0) {
        $GLOBALS['meaningErr'] = "Write sth and don't make it too long!";
        $check = false;
     }
   }
   return $check;
}

/*process input text, trim string, delete slash, retain htmlspecialchars*/
function input_process($input) {
  $d = trim($input);
  $d = stripslashes($d);
  $d = htmlspecialchars($d);
  return $d;
}
?>
