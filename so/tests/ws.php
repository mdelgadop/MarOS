<?php
 class persona {
  public $name = "Mario";
  public $nickname = "@mdelgadop";
  public $showNickname = true;
 }

$obj1 = new persona;

$obj2 = new persona;
$obj2->name = "Susan";
$obj2->nickname = "Sue";
$showNickname = false;

$obj[0] = $obj1;
$obj[1] = $obj2;

$obj = array($obj1,$obj2);

echo json_encode($obj);

?>
