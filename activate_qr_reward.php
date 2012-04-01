<?php
include ("db_connect.php");
?>

<?php
$player_id=$_GET['player_id'];
$qr_code=$_GET['qr_code'];

$result_code=mysql_query("SELECT * FROM qr_reward WHERE sn = '{$qr_code}'") or die(mysql_error());
if(mysql_num_rows($result_code)>0){
$row_code=mysql_fetch_array($result_code);
//verificare existenta
$res_check_exist=mysql_query("SELECT * FROM qr_reward_cooldown WHERE player_id = {$player_id} AND reward_id = {$row_code['id']}");
if(mysql_num_rows($res_check_exist)==0){$res_insert=mysql_query("INSERT INTO qr_reward_cooldown (player_id,reward_id,last_time) VALUES ({$player_id},{$row_code['id']},'".time()."')") or die(mysql_error());
//adaugare bonusuri
if($row_code['xp']!=0){
$res_user_desc=mysql_query("SELECT * FROM user_desc WHERE id_user = {$player_id}");
$row_user_desc=mysql_fetch_array($res_user_desc);
$level_user=intval($row_user_desc['level']);
$xp_user=intval($row_user_desc['experience']);
$xp_curent=$xp_user+intval($row_code['xp']);
$xp_gained = intval($row_code['xp']);

$res_player_xp_lvl_crt=mysql_query("SELECT * FROM player_xp WHERE level = {$level_user}");
$row_player_xp_lvl_crt=mysql_fetch_array($res_player_xp_lvl_crt);
$res_player_xp_lvl_plus=mysql_query("SELECT * FROM player_xp WHERE level = ".($level_user+1)."");
$row_player_xp_lvl_plus=mysql_fetch_array($res_player_xp_lvl_plus);
$xp_nivel_plus=$row_player_xp_lvl_plus['xp'];
if($xp_curent>=$xp_nivel_plus){
$xp_curent=$xp_curent-$xp_nivel_plus;
$brt=intval($row_player_xp_lvl_plus['brut'])-intval($row_player_xp_lvl_crt['brut']);
$acc=intval($row_player_xp_lvl_plus['acc'])-intval($row_player_xp_lvl_crt['acc']);
$fort=intval($row_player_xp_lvl_plus['fort'])-intval($row_player_xp_lvl_crt['fort']);
$def=intval($row_player_xp_lvl_plus['def'])-intval($row_player_xp_lvl_crt['def']);
$special=intval($row_player_xp_lvl_plus['special']);
$res_special=mysql_query("SELECT name FROM special_attacks WHERE id_attack = {$special}");
$row_special=mysql_fetch_array($res_special);
$res_update=mysql_query("UPDATE user_desc SET brutality = '{$row_player_xp_lvl_plus['brut']}', accuracy = '{$row_player_xp_lvl_plus['acc']}', fortitude = '{$row_player_xp_lvl_plus['fort']}', defense = '{$row_player_xp_lvl_plus['def']}', experience = '{$xp_curent}', level = '".($level_user+1)."' WHERE id_user = {$player_id}");
$xp_afis="{$xp_gained}/{$xp_curent}/{$brt}/{$acc}/{$fort}/{$def}/{$row_special['name']}";
                              }
else{
$res_update=mysql_query("UPDATE user_desc SET experience = '{$xp_curent}' WHERE id_user = {$player_id}");
$xp_afis="{$xp_gained}";
    }
                      }
if($row_code['item']!=0){
$items_afis="";
$res_items=mysql_query("SELECT * FROM items_inventory WHERE loot = {$row_code['item']}");
while($row_items=mysql_fetch_array($res_items)){
$items_afis.="{$row_items['name']}/";
//verific daca am itemu asta
$res_check_item=mysql_query("SELECT * FROM items_home WHERE id_user = {$player_id} AND id_item = {$row_items['id_item']}");
if(mysql_num_rows($res_check_item)==0)mysql_query("INSERT INTO items_home (id_user,id_item,quantity,active) VALUES ({$player_id},{$row_items['id_item']},'1',0)");
else{
$row_check_item=mysql_fetch_array($res_check_item);
$cant=intval($row_check_item['quantity']);
$cant++;
mysql_query("UPDATE items_home SET quantity = '{$cant}' WHERE id_user = {$player_id} AND id_item = {$row_items['id_item']}");
    }

}
                      }	
if($row_code['cash']!=0){
$res_update=mysql_query("SELECT * FROM home WHERE id_user = {$player_id}");
$row_update=mysql_fetch_array($res_update);
$moneyi=intval($row_update['money'])+intval($row_code['cash']);
$res_update=mysql_query("UPDATE home SET money = '{$moneyi}' WHERE id_user = {$player_id}");
                      }					  


//afisare bonusuri
$res_miss_name=mysql_query("SELECT * FROM missions WHERE id = {$row_code['mission']}");
$row_miss_name=mysql_fetch_array($res_miss_name);
$res_mons_name=mysql_query("SELECT * FROM mobs_desc WHERE id = {$row_code['monster']}");
$row_mons_name=mysql_fetch_array($res_mons_name);
echo "{$xp_afis}-{$row_miss_name['name']}-{$row_mons_name['name']}-{$row_code['cash']}-{$items_afis}";
}
else{
//verificare cooldown
$acum=time();
$row_check_cool=mysql_fetch_array($res_check_exist);
$last_time=intval($row_check_cool['last_time']);
$cooldown=intval($row_code['cooldown']);
if($acum-$last_time>$cooldown){
//update last_time
$res_update=mysql_query("UPDATE qr_reward_cooldown SET last_time = '".time()."' WHERE player_id = {$player_id} AND reward_id = {$row_code['id']}");
//adaugare bonusuri
if($row_code['xp']!=0){
$res_user_desc=mysql_query("SELECT * FROM user_desc WHERE id_user = {$player_id}");
$row_user_desc=mysql_fetch_array($res_user_desc);
$level_user=intval($row_user_desc['level']);
$xp_user=intval($row_user_desc['experience']);
$xp_curent=$xp_user+intval($row_code['xp']);
$xp_gained = intval($row_code['xp']);

$res_player_xp_lvl_crt=mysql_query("SELECT * FROM player_xp WHERE level = {$level_user}");
$row_player_xp_lvl_crt=mysql_fetch_array($res_player_xp_lvl_crt);
$res_player_xp_lvl_plus=mysql_query("SELECT * FROM player_xp WHERE level = ".($level_user+1)."");
$row_player_xp_lvl_plus=mysql_fetch_array($res_player_xp_lvl_plus);
$xp_nivel_plus=$row_player_xp_lvl_plus['xp'];
if($xp_curent>=$xp_nivel_plus){
$xp_curent=$xp_curent-$xp_nivel_plus;
$brt=intval($row_player_xp_lvl_plus['brut'])-intval($row_player_xp_lvl_crt['brut']);
$acc=intval($row_player_xp_lvl_plus['acc'])-intval($row_player_xp_lvl_crt['acc']);
$fort=intval($row_player_xp_lvl_plus['fort'])-intval($row_player_xp_lvl_crt['fort']);
$def=intval($row_player_xp_lvl_plus['def'])-intval($row_player_xp_lvl_crt['def']);
$special=intval($row_player_xp_lvl_plus['special']);
$res_special=mysql_query("SELECT name FROM special_attacks WHERE id_attack = {$special}");
$row_special=mysql_fetch_array($res_special);
$res_update=mysql_query("UPDATE user_desc SET brutality = '{$row_player_xp_lvl_plus['brut']}', accuracy = '{$row_player_xp_lvl_plus['acc']}', fortitude = '{$row_player_xp_lvl_plus['fort']}', defense = '{$row_player_xp_lvl_plus['def']}', experience = '{$xp_curent}', level = '".($level_user+1)."' WHERE id_user = {$player_id}");
$xp_afis="{$xp_gained}/{$xp_curent}/{$brt}/{$acc}/{$fort}/{$def}/{$row_special['name']}";

                              }
else{
$res_update=mysql_query("UPDATE user_desc SET experience = '{$xp_curent}' WHERE id_user = {$player_id}");
$xp_afis="{$xp_gained}";
    }
                      }
if($row_code['item']!=0){
$items_afis.="";
$res_items=mysql_query("SELECT * FROM items_inventory WHERE loot = {$row_code['item']}");
while($row_items=mysql_fetch_array($res_items)){
$items_afis.="{$row_items['name']}/";
//verific daca am itemu asta
$res_check_item=mysql_query("SELECT * FROM items_home WHERE id_user = {$player_id} AND id_item = {$row_items['id_item']}");
if(mysql_num_rows($res_check_item)==0)mysql_query("INSERT INTO items_home (id_user,id_item,quantity,active) VALUES ({$player_id},{$row_items['id_item']},'1',0)");
else{
$row_check_item=mysql_fetch_array($res_check_item);
$cant=intval($row_check_item['quantity']);
$cant++;
mysql_query("UPDATE items_home SET quantity = '{$cant}' WHERE id_user = {$player_id} AND id_item = {$row_items['id_item']}");
    }

}
                      }	
if($row_code['cash']!=0){
$res_update=mysql_query("SELECT * FROM home WHERE id_user = {$player_id}");
$row_update=mysql_fetch_array($res_update);
$moneyi=intval($row_update['money'])+intval($row_code['cash']);
$res_update=mysql_query("UPDATE home SET money = '{$moneyi}' WHERE id_user = {$player_id}");
                      }					  


//afisare bonusuri
$res_miss_name=mysql_query("SELECT * FROM missions WHERE id = {$row_code['mission']}");
$row_miss_name=mysql_fetch_array($res_miss_name);
$res_mons_name=mysql_query("SELECT * FROM mobs_desc WHERE id = {$row_code['monster']}");
$row_mons_name=mysql_fetch_array($res_mons_name);
echo "{$xp_afis}-{$row_miss_name['name']}-{$row_mons_name['name']}-{$row_code['cash']}-{$items_afis}";
                              }
else {
$ramas=$cooldown-($acum-$last_time);
$h=floor($ramas/3600);
$m=floor(($ramas-$h*3600)/60);
$s=$ramas-$h*3600-$m*60;
echo "Time left:{$h}h {$m}m {$s}s";
     }							  
}



}
else echo "FAIL";

?>