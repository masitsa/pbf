<?php 
	//require_once('top.php');
	require_once('pesapal/OAuth.php');
	require_once('pesapal/checkStatus.php');
	require_once('db/dbconnector.php');

    $pesapalMerchantReference	= null;
    $pesapalTrackingId 		= null;
    $checkStatus 				= new pesapalCheckStatus();
    
    if(isset($_GET['pesapal_merchant_reference']))
        $pesapalMerchantReference = $_GET['pesapal_merchant_reference'];
        
    if(isset($_GET['pesapal_transaction_tracking_id']))
        $pesapalTrackingId = $_GET['pesapal_transaction_tracking_id'];
        
    /** check status of the transaction made
      *There are 3 available API
      *checkStatusUsingTrackingIdandMerchantRef() - returns Status only. 
      *checkStatusByMerchantRef() - returns status only.
      *getMoreDetails() - returns status, payment method, merchant reference and pesapal tracking id
    **/
    
    //$status 			= $checkStatus->checkStatusByMerchantRef($pesapalMerchantReference);
    //$responseArray	= $checkStatus->getTransactionDetails($pesapalMerchantReference,$pesapalTrackingId);
   // $status 			= $checkStatus->checkStatusUsingTrackingIdandMerchantRef($pesapalMerchantReference,$pesapalTrackingId);
    
    //At this point, you can update your database.
    //In my case i will let the IPN do this for me since it will run
    //IPN runs when there is a status change  and since this is a new transaction, 
    //the status has changed for UNKNOWN to PENDING/COMPLETED/FAILED
    ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pesapal API Integration</title>

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

  </head>
  <body>
    <h1 align="center">Pesapal API Integration</h1>
    <div class="progress">
  <div class="progress-bar progress-bar-striped active"  role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
   
  </div>
</div>

 <div class="jumbotron" style="height:500px;" align="center">
  
    <div class="list-group" style="width:50%;">
          <a href="index.php" class="list-group-item active">
            <h4>Step3: Confirmation</h4>
        
            </p>
          </a>

           <a href="links.php" class="list-group-item ">
            <p class="list-group-item-text">Your payment has been received and is being processed. You will receive an email/sms notification once done. Thank you.</p>
            <p class="list-group-item-text"><?php echo $pesapalMerchantReference;?> <br/>
                                            <?php echo $pesapalTrackingId;?> 
            </p>
          </a>

    </div>
 
</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>