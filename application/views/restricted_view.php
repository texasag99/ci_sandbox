<?php include("header.php"); ?>

<div id="container">
<h1>Restricted!</h1>

<div id="body">
 <p style="max-width:800px; border:1px solid dark-gray; background-color:silver; padding:10px;">
  This page is RESTRICTED! </p>
 <p>You have attempted to access a page that is restricted. For security reasons you have been logged off the site. <a href='<?php echo base_url()."User/login"; ?>'>Please click here to login</a>
</p>
</div>
</div>

</body>
</html>


