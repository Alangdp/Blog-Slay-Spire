<?php 

include __DIR__ . '/../../lib/parsedown/Parsedown.php';

function validateProps() {
  $testCases = ["'", '"'];
  foreach($testCases as $test) {
    foreach($_POST as $key => $value) {
      if(str_contains($value, $test)) return false;
    }
  }

  return true;
}

function renderizarMarkdown($markdown)
{
  $parsedown = new Parsedown();
  $parsedown->setBreaksEnabled(true);
  return $parsedown->text($markdown);
}
