<?php

class Move {
  public $name;
  public $type;
  public $category;
  public $power;
  public $accuracy;
  public $pp;

  public function __construct($name, $type, $category, $power, $accuracy, $pp){
    $this->name     = $name;
    $this->type     = $type;
    $this->category = $category;
    $this->power    = $power;
    $this->accuracy = $accuracy;
    $this->pp       = $pp;
  }
}

$outrage = new Move("げきりん", "ドラゴン", "物理技", 120, 100, 10);
$dracoMeteor = new Move("りゅうせいぐん","ドラゴン", "特殊技", 130, 90, 5);