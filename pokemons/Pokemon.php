<?php

class Pokemon{
  public $name;
  public $level;
  public $hp;
  public $attack;
  public $defense;
  public $spAtk;
  public $spDef;
  public $speed;
  public $types = array();

  public function __construct($name, $level, $hp, $attack, $defense, $spAtk, $spDef, $speed, $types){
    $this->name    = $name;
    $this->level   = $level;
    $this->hp      = $hp;
    $this->attack  = $attack;
    $this->defense = $defense;
    $this->spAtk   = $spAtk;
    $this->spDef   = $spDef;
    $this->speed   = $speed;
    $this->types   = $types;
  }
}

$garchomp = new Pokemon("ガブリアス", 50, 183, 182, 115, 100, 106, 169, ["ドラゴン", "じめん"]);