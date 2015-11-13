<!-- Static navbar-->

<?php
$view_permission = array(
		'view_useradmin'=>FALSE,
		'view_roles'=>FALSE,
		'view_permissions'=>FALSE,
		'view_config'=>FALSE,
		'view_admin'=>FALSE,
		'view_audit'=>FALSE

);
if($this->session->userdata('permissions')) {
$all_permissions = $this->session->userdata('permissions');
$permission = array();
 foreach ($all_permissions as $value){
			$permission[]= $value->id;				
		}
	if(in_array(9005, $permission) ||in_array(9999, $permission)){$view_permission['view_useradmin'] = TRUE;}
  if(in_array(9030, $permission) ||in_array(9999, $permission)){$view_permission['view_roles'] = TRUE;}
  if(in_array(9050, $permission) ||in_array(9999, $permission)){$view_permission['view_permissions'] = TRUE;}
  if(in_array(9065, $permission) ||in_array(9999, $permission)){$view_permission['view_config'] = TRUE;}
   if(in_array(9080, $permission) ||in_array(9999, $permission)){$view_permission['view_audit'] = TRUE;}
  if($view_permission['view_useradmin'] ||$view_permission['view_roles'] ||$view_permission['view_permissions']||$view_permission['view_config']||$view_permission['view_audit']){
		$view_permission['view_admin'] = TRUE;	}
}

?>

<nav role="navigation" class="navbar navbar-default">
  <div class="container-fluid">
	 <div class="navbar-header">
		 <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
		 <a class="navbar-brand" href="#"><?php echo APPLICATION_TITLE; ?> <span class="version_number">Version <?php  echo APPLICATION_VERSION; ?></a>
	  </div><!--navbar-header-->
     <div class="navbar-collapse collapse">		 
    <?php if ($this->session->userdata('is_logged_in')){ ?> 
	  <ul class ="nav navbar-nav nav-default">
	  <?php if ($view_permission['view_admin']){ ?>
		  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Admin<span class="caret"></span></a>
			  <ul class="dropdown-menu" role="menu">
			  <?php
			  if($view_permission['view_useradmin']){ echo "<li><a href='".base_url()."UserAdmin'>Users</a></li>";}
			  if($view_permission['view_roles']){ echo "<li><a href='".base_url()."Roles'>Roles</a></li>";}
			  if($view_permission['view_permissions']){ echo "<li><a href='".base_url()."Permissions'>Permissions</a></li>";}
			  if($view_permission['view_config']){ echo "<li><a href='".base_url()."Config'>Settings</a></li>";}
			  if($view_permission['view_audit']){ echo "<li><a href='".base_url()."Audit'>Audit</a></li>";}
			  ?>			  
			  </ul>
		  </li>
		  <?php }else{ echo "  ";}?>	
	  </ul>
	  <?php }else{ echo "  ";}?>		 
	  <ul class="nav navbar-nav navbar-right">
			 <?php if ($this->session->userdata('is_logged_in')){
			 	$profile_pic = $this->session->userdata('profile_pic');			 	 
				 if(!isset($profile_pic) && empty($profile_pic)) { 
				 $profile_pic = "<img src='".base_url()."uploads/generic_user.jpg' class='nav_profile_pic'/>"; 
				 }else{
				$profile_pic = "<img src='".base_url()."uploads/profile_pics/".$profile_pic."' class='nav_profile_pic'/>";  
				}
				echo"<li><a href='".base_url()."Profile'> ".$profile_pic."&nbsp;&nbsp;".$this->session->userdata('name')."</a></li>";
				echo"<li><a href='".base_url()."User/logout'><span class='glyphicon glyphicon-off'></span> Logout</a></li>";
				}else{
				?>
			 <li><a href="<?php echo base_url().'User/login' ?>"><span class="glyphicon glyphicon-off"></span> Login</a></li>
			 <?php
				}
			 ?>
      </ul>
	  
    </div><!--navbar-collapse collapse-->
  </div><!--container-fluid-->
</nav><!--navbar navbar-default -->	