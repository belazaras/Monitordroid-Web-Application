<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Contacts</title>

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
               
            });
            function sendPushNotification(id){
                var data = $('form#'+id).serialize();
                $('form#'+id).unbind('submit');                
                $.ajax({
                    url: "send_message.php",
                    type: 'GET',
                    data: data,
                    beforeSend: function() {
                        
                    },
                    success: function(data, textStatus, xhr) {
                          $('.txt_message').val("");
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        
                    }
                });
                return false;
            }
        </script>
        <style type="text/css">
            ul.devices li .send_btn{
                background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#0096FF), to(#005DFF));
                background: -webkit-linear-gradient(0% 0%, 0% 100%, from(#0096FF), to(#005DFF));
                background: -moz-linear-gradient(center top, #0096FF, #005DFF);
                background: linear-gradient(#0096FF, #005DFF);
                text-shadow: 0 1px 0 rgba(0, 0, 0, 0.3);
                border-radius: 3px;
                color: #fff;
            }
        </style>

</head>



<body>
    <a href="javascript:history.back()">Home</a>
    <p>Instructions: Press "Update Contacts" to send the update command to your device. Wait 20 seconds, and then refresh your page (Confirm the page resubmittion) and any new contacts should appear. If they have not appeared yet, wait another minute and continue refreshing the page. Please do not continuously click the "Update Contacts" button as it will slow down your device and our servers! </p>
    <?php

	/**

	*contacts.php

	*Written by: Tyler Butler

	*Email: butler.tyler.355@gmail.com

	*Purpose: Display saved contact information from the database in the web application

	*/

	

    // receive data from HTML Contacts request
	
	if (!isset($_POST['registration']) && !isset($_POST['rowid'])) {
	header("location:index.php");
	exit();		
	}

	$rName=$_POST["registration"];
    $rowId=$_POST["rowid"];


	include_once './db_functions.php';

	$db = new DB_Functions();
	?>
    
    <form id="<?php echo $rowId ?>" name="" method="post" onsubmit="return sendPushNotification('<?php echo $rowId ?>')">                             
    <input type="hidden" name="message" value="contacts" />
    <input type="hidden" name="regId" value="<?php echo $rName ?>"/>
    <input type="submit" class="send_btn" value="Update Contacts" onclick=""/>
    <br />
    
    <?php

	$ContactList = $db->getContacts($rName);

	echo nl2br($ContactList);        
                 

    ?>



</body>

</html>