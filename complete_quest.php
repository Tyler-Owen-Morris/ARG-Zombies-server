<?php

//misiune completa si intoarce loot-ul

include ("db_connect.php");

?>



<?php

$mission_id=$_GET['mission_id'];

$player_id=$_GET['player_id'];



$res_missions=mysql_query("SELECT * FROM missions WHERE id = {$mission_id}");

if(mysql_num_rows($res_missions)>0)

while($row_missions=mysql_fetch_array($res_missions)){

//marcare misiune ca fiind completa

$res_check_complete=mysql_query("SELECT * FROM mission_player WHERE mission_id = {$mission_id} AND user_id = {$player_id}");

$row_check_complete=mysql_fetch_array($res_check_complete);

if($row_check_complete['completed']==0){

$res=mysql_query("UPDATE mission_player SET completed = 1 WHERE mission_id = {$mission_id} AND user_id = {$player_id}");



//adaugare reward

if($row_missions['reward']==1){

$res_user_desc=mysql_query("SELECT * FROM user_desc WHERE id_user = {$player_id}");

$row_user_desc=mysql_fetch_array($res_user_desc);

$level_user=intval($row_user_desc['level']);

$xp_user=intval($row_user_desc['experience']);

$xp_curent=$xp_user+intval($row_missions['reward_cantitate']);



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

echo "XP-{$xp_curent}-{$brt}-{$acc}-{$fort}-{$def}-{$row_special['name']}<br />";

                              }

else{

$res_update=mysql_query("UPDATE user_desc SET experience = '{$xp_curent}' WHERE id_user = {$player_id}");

echo "XP-";

echo $row_missions['reward_cantitate']."<br />";

    }							  



/*echo "XP-";

echo $row_missions['reward_cantitate']."<br />";

$res_update=mysql_query("SELECT * FROM user_desc WHERE id_user = {$player_id}");

$row_update=mysql_fetch_array($res_update);

$xpul=intval($row_update['experience'])+intval($row_missions['reward_cantitate']);

$res_update=mysql_query("UPDATE user_desc SET experience = '{$xpul}' WHERE id_user = {$player_id}");

*/

}

if($row_missions['reward']==2){

echo "Cash-";

echo $row_missions['reward_cantitate']."<br />";

$res_update=mysql_query("SELECT * FROM home WHERE id_user = {$player_id}");

$row_update=mysql_fetch_array($res_update);

$moneyi=intval($row_update['money'])+intval($row_missions['reward_cantitate']);

$res_update=mysql_query("UPDATE home SET money = '{$moneyi}' WHERE id_user = {$player_id}");}

if($row_missions['reward']==3){

echo "Loot-";

echo $row_missions['reward_cantitate']."<br />";

$res_items=mysql_query("SELECT * FROM items_inventory WHERE loot = {$row_missions['reward_cantitate']}");

while($row_items=mysql_fetch_array($res_items)){

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

                                         }

}





?>