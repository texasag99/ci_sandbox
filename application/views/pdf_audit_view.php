<?php  ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User Audit Report</title>
	<style>
	.body{
		width:100%;
		font-family:tahoma;
			
	}
	.record_header{
	  width: 592px;
	  background-color:black;
	  color: white;
	  margin-top:10px;
	  text-align:left;
	  padding:5px;
	}
	.record_body{
	  width: 600px;
	  border:1px black solid;
	}
	.label{

	 width:148px;
	 background-color:gray;
	 color:white;
	 border:1px gray solid;
	 text-align:right;
	 padding 5px;
	}
	.value{
	 width:148px;
	 background-color:white;
	 color:black;
	 text-align:left;
	 padding:5px;
	}
	
	</style>
	</head>
	<body>
<?php 

echo "<div class ='body'><h1>User Audit Report</h1><p>This report was created on <strong>".date("Y-m-d H:i:s")."</strong></p>";
 foreach ($results as $data){
		if ($data->status == 0){
		   $status = "Failure";
		}else{
			$status= "Success";
			}
			echo"<div class='record_header'>ID: ".$data->id."</div>";
			echo" <div class='record_body'><span class='label'>Primary: </span><span class='value'>".$data->primary."</span>";
			echo" <span class='label'>Secondary: </span><span class='value'>".$data->secondary."</span>";
		   $user_email = (strlen($data->user_email) > 17) ? substr($data->user_email,0,17).'...' : $data->user_email ;
		   echo" <span class='label'>User email: </span><span class='value'>".$user_email."</span>";
		   echo" <span class='label'>IP Address: </span><span class='value'>".$data->ip_address."</span><br>";		
			echo" <span class='label'>Status: </span><span class='value'>".$status."</span>";	
			echo" <span class='label'>Date/Time: </span><span class='value'>".date('m-d-Y H:i:s', strtotime($data->datetime))."</span>";
			$session_id = (strlen($data->session_id) > 10) ? substr($data->session_id,0,9).'...' : $data->session_id ;
			echo" <span class='label'>Session ID: </span><span class='value'>".$session_id."</span>";	
			$uri = (strlen($data->uri) > 10) ? substr($data->uri,0,9).'...' : $data->uri ;
			echo" <span class='label'>URI: </span><span class='value'>".$uri."</span>";	
			$value = (strlen($data->value) > 13) ? substr($data->value,0,13).'...' : $data->value ;
			echo" <span class='label'>Value: </span><span class='value'>".$value."</span></div>";	
		
}	
echo  "</div></body></html>";