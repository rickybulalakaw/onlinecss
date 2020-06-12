<?php

/* 
 * This page is for creation of surveys
 */

require_once("db.php");

if(isset($_POST['createsurvey']))
{
    $officeid = strip_tags($_POST['officeid']);
    $servicename = strip_tags($_POST['servicename']);
    
    $officeid = stripslashes($officeid);
    $servicename = stripslashes($servicename);
    
    $officeid = mysqli_real_escape_string($db, $officeid);
    $servicename = mysqli_real_escape_string($db, $servicename);
        
    if($officeid == "")
        {
            echo "Please do not leave the Office providing service field blank. Please click back on your browser and enter the required details.";
            return;
        }
        
        if($servicename == "")
        {
            echo "Please do not leave the Service Name field blank. Please click back on your browser and enter the required details.";
            return;
        }
        
        $addsurvey = "insert into service (Servicename, Officeid) values ('$servicename', '$officeid')";
        if ($db->query($addsurvey) === TRUE )
        {
            // get db data of id of survey
            
            $getserviceid = "select id from service where Servicename = '$servicename'";
            $resultgetserviceid = $db->query($getserviceid);
            $resultdataserviceid = $resultgetserviceid->fetch_assoc();
            $surveynumber = $resultdataserviceid['id'];
            
            header("Location:editsurvey.php?id=$surveynumber"); // 
        } else {
            
            echo "Error: ".$db->error;
            
        }
        
    
    
}



?>

<html>
    <head>
        <title>Service Survey Creation Tool</title>
    </head>    
    <body>
        <h1>Service Survey Creation Tool</h1>
        <form action="createsurvey.php" method ="post" enctype="multipart/form-data">
            
            <b>Office providing service</b><br />
            Select office for the service:
            <?php 
            
            // This shall be updated based on the central office table
            
            $selectactiveoffices = "select officeid, officename from office where status = 'Active' order by officename";
            $result1 = $db->query($selectactiveoffices);
            echo "<select name='officeid'>";
            echo "<option value = ''></option>";
            while($data1 = $result1->fetch_assoc())
            {
                echo "<option value='".$data1['officeid']."'>".$data1['officename']."</option>";
                
            }
            echo "</select>";
            echo "<br /><br />";
            
            
            ?>
            
            <b>Name of Service</b><br />
              
            Enter the name of the service you want to create a survey for<br /> 
            
            
            <textarea rows="3" cols="50" name="servicename"  maxlength="1500" >e.g., Photocopying Service</textarea><br />
            <br />
            
            
            <b>Please check the name of the service before clicking "Create" below</b><br /><br />
            <input name="createsurvey" type="submit" value="Create Service Survey">
            <br />
            <br />
            <a href='index.php'>Go to the Home page</a>
        </form>            
    </body>
</html>