<?php



//get user access 

function get_access($user_id){

$res=mysql_query("SELECT * FROM admin_section_access WHERE user_id = {$user_id}") or die(mysql_error());

$sections=array();

if(mysql_num_rows($res)==0)return $sections;

else{

$sections=array();

while($row=mysql_fetch_array($res)){

$section[]=$row['section_id'];

                                   }

return $section;								  

    }

}



?>