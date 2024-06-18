<?php 

function validateProps() {
  $testCases = ["'", '"'];
  foreach($testCases as $test) {
    foreach($_POST as $key => $value) {
      if(str_contains($value, $test)) return false;
    }
  }

  return true;
  
}