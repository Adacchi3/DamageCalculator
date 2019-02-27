<?php

require('./pokemons/Pokemon.php');
require('./moves/Move.php');
require('./DamageCalculator.php');

$partner = $garchomp;
$enemy   = $garchomp;

$move    = $outrage;
$move    = $dracoMeteor;

$damage  = calculateDamage($partner, $enemy, $move);
$effectiveness = calculateTypeEffectiveness($move, $enemy);

echo $partner->name."の　".$move->name."！"."\n";
echo "\n";

echo "相手の　".$enemy->name."に　".$damage."のダメージ！"."\n";
if($effectiveness>1){
  echo "効果は　バツグンだ！"."\n";
}else if($effectiveness<1){
  echo "効果は　いまひとつのようだ．\n";
}
echo "\n";

if($enemy->hp-$damage<=0){
  echo "相手の　".$enemy->name."は　たおれた！"."\n";
}else{
  $rate = floor($damage/$enemy->hp*pow(10,3))/10;
  echo "相手の ".$enemy->name."の 体力を　".$rate."%削った！\n";
}
