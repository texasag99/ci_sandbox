<?php include("header.php"); ?>

<div id="container">
	<h1><?php echo $page_header; ?></h1>

	<div id="body">
	
	 <h2>Instructions</h2>

	 <p style="max-width:800px; border:1px solid dark-gray; background-color:silver; padding:10px;">
     This calculator works by entering the values you wish to calculate in the URL
	 address. Immediately after the "/calc" portion of the web address, you can submit
	 requests such as /add or /subtract or /multiply. For example, if I want to 
	 add 2 + 2, I would enter "/calc/add/2/2" in the address and the results would be displayed. Try it!</p>

     <?php echo $page_content; ?>

	</div>

</div>

</body>

</html>
