<?php
    require_once('./upload.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <head>
        <title>File Uploader</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <script type="text/javascript" src="mootools/mootools-1.2.1-core-nc.js"></script>
        <script type="text/javascript">
	window.addEvent('load', function() {
		  $('submit').addEvent('click', function() 
		  {
		      var finished = false;
		      var percent  = 0.0;
		      var total    = 0;
		      var complete = 0;
		      var perform;
		      var periodical;
		      
		      var morph = new Fx.Tween('status');
			var request = new Request({
			    url: 'status.php?id=<?php echo $id ; ?>',
			    method: 'get',
			    update: 'status',
			    onComplete: function(response) {
				    objectsReturned = JSON.decode(response);
				    $each(objectsReturned, function(item, index){
					    
					    if (index=="finished")
					    {
						    finished = item;
						    if (finished==true)
						      $clear(periodical);
					    }
					    
					    if (index=="percent")
						    percent = item;
					    if (index=="total")
						    total = item;
					    if (index=="complete")
						    complete = item;
					    
				    });
				    <?php
				      if ($_SESSION[$SESSION_KEY]["handler"]=="noplugin")
				      {
				    ?>
				      if (!finished)
				      {
					$('info').set('html', 'Information about upload progress are not available.');
				      }
				      else 
				      {
				    <?php 
				    }
				    ?>
				      $('info').set('html', 'Percent: '+Math.round(percent)+'%<br />'
							  +'Received: '+complete+'<br />'
							  +'Total: '+total+'<br />'
							  +'Finished: '+finished+'<br />'); 
				      $('status').tween('width', Math.round(percent)*2+'px');
				    <?php
				    if ($_SESSION[$SESSION_KEY]["handler"]=="noplugin")
				    {
				    ?>
				      }
				    <?php
				    }
				    ?>
			    }
			  });
			
			perform = function () {
			      request.send();
			}

			periodical = perform.periodical(1000);
			
		  });

		  
	  });
	</script>
    </head>
    <body>
	<!-- invisible iframe -->
	<iframe id="upload_iframe" name="upload_iframe" width="300" height="300" src="upload_form.php?id=<?php echo $id ?>" style="display: none;"></iframe>
	<!-- we need to set enctype='multipart/form-data' so the form can handle files -->
        <form method="post" action="upload_form.php" target="upload_iframe" enctype='multipart/form-data' id="theForm">
            <div id="post_form">
	        <!-- ID has to be set, so the status script can get status of the upload, variables $ID_KEY and $id are obtained from PHP upload part -->
                <input type="hidden" name="<?php echo $ID_KEY; ?>" value="<?php echo $id ; ?>" /> 
                <input type="file" name="myFile" /> 
                <input type="submit" name="submit" value="Upload file..." id="submit" />
            </div>
        </form>
	<br />
	<!-- Our progress bar -->
	<div style="border: 1px solid black; width: 202px;"> 
	  <div id="status" style="background-color: #D3DCE3; width: 0px; height: 12px; margin: 1px;">
	  </div>
	</div>
	<!-- Some useful information about the upload progress -->
	<div id="info">
	Handler: <?php echo $_SESSION[$SESSION_KEY]["handler"]; ?><br />
	<?php
	if ($_SESSION[$SESSION_KEY]["handler"]!="noplugin")
	{
	?>
	  Percent: 0%<br />
	  Received: 0<br />
	  Total: 0<br />
	  Finished: false<br />
	 <?php
	 }
	 else {
	 ?>
	  Information about upload progress are not available.
	 <?php
	 }
	 ?>
	</div>
    </body>
</html>