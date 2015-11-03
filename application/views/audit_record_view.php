<?php
if(ISSET($_SERVER['HTTP_REFERER'])){
	$go_back_url = $_SERVER['HTTP_REFERER'];
}else{ 
    $go_back_url = base_url().'/User/login';
}
?>

<div id="container" class="container-fluid">
<h1><?php echo $page_header; ?></h1>
<div id="body">
<br><br>
<div class="col-md-2">
<div id="audit_record">
<div class="panel panel-default">
<div class="panel-heading text-center "><h3>Audit Information</h3></div>
<div class="panel-body"> 
<p>The current audit information below is related to a specific event.</p></div>
<table class="table-condensed">
<thead>
<tr>
<th class='text-right'></th>
<th  >Audit Data</th>
</tr></thead>
<tbody class="table-hover">
<tr><td class='text-right'>ID:</td><td>&nbsp;<?php echo $id; ?><td></tr>
<tr><td class='text-right'>Datetime:</td><td>&nbsp;<?php echo $datetime; ?><td></tr>
<tr><td class='text-right'>Primary:</td><td>&nbsp;<?php echo $primary; ?><td></tr>
<tr><td class='text-right'>Secondary:</td><td>&nbsp;<?php echo $secondary; ?><td></tr>
<tr><td class='text-right'>Session ID:</td><td>&nbsp;<?php echo $session_id; ?><td></tr>
<tr><td class='text-right'>User Email:</td><td>&nbsp;<?php echo $user_email; ?><td></tr>
<tr><td class='text-right'>Status:</td><td>&nbsp;<?php echo $status; ?><td></tr>
<tr><td class='text-right'>URI:</td><td>&nbsp;<?php echo $uri; ?><td></tr>
<tr><td class='text-right'>Controller:</td><td>&nbsp;<?php echo $controller; ?><td></tr>
<tr><td class='text-right'>Value:</td><td>&nbsp;<?php echo $value; ?><td></tr>
<tr><td class='text-right'>IP Address:</td><td>&nbsp;<?php echo $ip_address; ?><td></tr>
<tr><td class='text-right'>HTTP Agent:</td><td style="max-width:400px; word-wrap:break-word;"><div style="word-wrap: break-word;"><?php echo $http_agent; ?></div><td></tr>
<tr><td class='text-right'>HTTP Host Data:</td><td style="max-width:400px; word-wrap:break-word;"><div style="word-wrap: break-word;"><?php echo $http_host_data; ?></div><td></tr>
<tr><td class='text-right'>Environmentals:</td><td style="max-width:400px; word-wrap:break-word;"><div style="word-wrap: break-word;"><?php echo $environmentals; ?></div><td></tr>
<tr><td class='text-right'>Extra 1:</td><td>&nbsp;<?php echo $extra_1; ?><td></tr>
<tr><td class='text-right'>Extra 2:</td><td>&nbsp;<?php echo $extra_2; ?><td></tr>
<tr><td class='text-right'>Extra 3:</td><td>&nbsp;<?php echo $extra_3; ?><td></tr>
</tbody>
</table>
<p></p>
</div>
</div>
</div>
</div>
</div>


