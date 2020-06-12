<?php

/* 
 * This page processes POST inputs from createsurveylink.php 
 */

require_once ("db.php"); 

if(isset($_POST['servicetransactionrequest']))
{
    require_once ("db.php"); 
    
    $typeofclient = $_POST['internalexternal'];
    
     $oostatement = strip_tags($_POST['oostatement']);
                       
     $oostatement = stripslashes($oostatement);
                        
     
     $oostatement = mysqli_real_escape_string($db, $oostatement);
                        
    
} else {
    header("Location: index.php"); 
}
