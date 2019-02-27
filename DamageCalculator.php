<?php

function calculateDamage($attackr, $defender, $move){
  switch($move->category){
    case "変化技":
      return 0;
      break;
    case "物理技":
      if($defender->defense==0)return -1;
      $damage = floor(($attackr->level)*2/5+2);
      $damage = $damage*floor(($move->power)*($attackr->attack)/($defender->defense))/50+2;
      $damage = floor($damage*random());
      $damage = floor($damage*calculateTypeEffectiveness($move, $defender));
      $damage = round($damage*containType($attackr, $move));
      return $damage;
      break;
    case "特殊技":
      if($defender->spDef==0)return -1;
      $damage = floor(($attackr->level)*2/5+2);
      $damage = $damage*floor(($move->power)*($attackr->spAtk)/($defender->spDef))/50+2;
      $damage = floor($damage*random());
      $damage = floor($damage*calculateTypeEffectiveness($move, $defender));
      $damage = round($damage*containType($attackr, $move));
      return $damage;
      break;
  }
}

function random(){
  return mt_rand(85, 100)/100;
}

function containType($attackr, $move){
  return in_array($move->type, $attackr->types) ? 1.5 : 1;
}

function calculateTypeEffectiveness($move, $defender){
  $effectiveness = 1;
  foreach($defender->types as $type){
    $effectiveness = $effectiveness*fetchTypeEffectiveness($move->type, $type);
  }
  return $effectiveness;
}

function fetchTypeEffectiveness($type1, $type2){
  $types = ["ノーマル","ほのお","みず","でんき","くさ","こおり"];
  $types = array_merge($types, ["かくとう","どく","じめん","ひこう","エスパー","むし"]);
  $types = array_merge($types, ["いわ","ゴースト","ドラゴン","あく","はがね","フェアリー"]);
  $normal = [  1,   1,   1,   1,   1,   1,   1,   1,   1,   1,   1,   1, 0.5,   0,   1,   1, 0.5,   1];
  $hono   = [  1, 0.5, 0.5,   1,   2,   2,   1,   1,   1,   1,   1,   2, 0.5,   1, 0.5,   1,   2,   1];
  $mizu   = [  1,   2, 0.5,   1, 0.5,   1,   1,   1,   2,   1,   1,   1,   2,   1, 0.5,   1,   1,   1];
  $denki  = [  1,   1,   2, 0.5, 0.5,   1,   1,   1,   0,   2,   1,   1,   1,   1, 0.5,   1,   1,   1];
  $kusa   = [  1, 0.5,   2,   1, 0.5,   1,   1, 0.5,   2, 0.5,   1, 0.5,   2,   1, 0.5,   1, 0.5,   1];
  $kori   = [  1, 0.5, 0.5,   1,   2, 0.5,   1,   1,   2,   2,   1,   1,   1,   1,   2,   1, 0.5,   1];
  $kakuto = [  2,   1,   1,   1,   1,   2,   1, 0.5,   1, 0.5, 0.5, 0.5,   2,   0,   1,   2,   2, 0.5];
  $doku   = [  1,   1,   1,   1,   2,   1,   1, 0.5, 0.5,   1,   1,   1, 0.5, 0.5,   1,   1,   0,   2];
  $jimen  = [  1,   2,   1,   2, 0.5,   1,   1,   2,   1,   0,   1, 0.5,   2,   1,   1,   1,   2,   1];
  $hiko   = [  1,   1,   1, 0.5,   2,   1,   2,   1,   1,   1,   1,   2, 0.5,   1,   1,   1, 0.5,   1];
  $esper  = [  1,   1,   1,   1,   1,   1,   2,   2,   1,   1, 0.5,   1,   1,   1,   1,   0, 0.5,   1];
  $mushi  = [  1, 0.5,   1,   1,   2,   1, 0.5, 0.5,   1, 0.5,   2,   1,   1, 0.5,   1,   2, 0.5, 0.5];
  $iwa    = [  1,   2,   1,   1,   1,   2, 0.5,   1, 0.5,   2,   1,   2,   1,   1,   1,   1, 0.5,   1];
  $ghost  = [  0,   1,   1,   1,   1,   1,   1,   1,   1,   1,   2,   1,   1,   2,   1, 0.5,   1,   1];
  $dragon = [  1,   1,   1,   1,   1,   1,   1,   1,   1,   1,   1,   1,   1,   1,   2,   1, 0.5,   0];
  $aku    = [  1,   1,   1,   1,   1,   1, 0.5,   1,   1,   1,   2,   1,   1,   2,   1, 0.5,   1, 0.5];
  $hagane = [  1, 0.5, 0.5, 0.5,   1,   2,   1,   1,   1,   1,   1,   1,   2,   1,   1,   1, 0.5,   2];
  $fairy  = [  1, 0.5,   1,   1,   1,   1,   2, 0.5,   1,   1,   1,   1,   1,   1,   2,   2, 0.5,   1];

  $typechart = [$normal, $hono, $mizu, $denki, $kusa, $kori, $kakuto, $doku, $jimen, $hiko, $esper, $mushi, $iwa, $ghost, $dragon, $aku, $hagane, $fairy];
  
  $type1Index = array_search($type1, $types);
  $type2Index = array_search($type2, $types);
  return $typechart[$type1Index][$type2Index];
}