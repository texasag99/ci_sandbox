<?php

echo "<div class ='body'><h1>User Report</h1><p>This report was created on <strong>".date("Y-m-d H:i:s")."</strong></p>";
echo "<table><thead><tr><td class='user_column' style='width:150px; background_color:black; color:white;'>Name</td>";
echo "<td class='user_email_column' style='width:200px; background_color:black; color:white;'>Email</td>";
echo "<td class='user_status_column' style='width:95px; background_color:black; color:white;'>Status</td>";
echo "<td class='user_locked_column' style='width:95px; background_color:black; color:white;'>Locked</td>";
echo "<td class='user_created_column' style='width:120px; background_color:black; color:white;'>Created On</td>";
echo "<td class='user_updated_column' style='width:120px; background_color:black; color:white;'>Last Updated</td>";
echo "<td class='user_updated_column' style='width:120px; background_color:black; color:white;'>Last Activity</td></tr></thead><tbody>";
 foreach ($results as $data){
	if ($data->locked == 0){
		   $locked = "No";
		}else{
			$locked = "Yes";
			}
                 echo "<tr><td class='user_column'> ".$data->first." ".$data->last." </td>";
                 echo "<td class='user_email_column'> ".$data->email." </td>";
                 echo "<td class='user_status_column'> ".$data->status." </td>";
                 echo "<td class='user_locked_column'> ".$locked." </td>";
                 echo "<td class='user_created_column'> ".date('m-d-Y', strtotime($data->created))." </td>";
                 echo "<td class='user_updated_column'> ".date('m-d-Y', strtotime($data->last_updated))." </td>";
                 echo "<td class='user_updated_column'> ".date('m-d-Y', strtotime($data->last_activity))." </td></tr>";
}	
echo  "</tbody></table></div>";