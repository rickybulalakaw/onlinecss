<?php

/* 
 * This page processes inputs from addnewresponseoption.php 
 */

require_once("db.php");

if(isset($_POST['submitnewresponseoption']))
{
    
    $questionid = $_POST['questionid'];
    $serviceid = $_POST['serviceid'];
    $display2 = strip_tags($_POST['display']);
    $value2 = strip_tags($_POST['value']);
    
    $display2 = stripslashes($display2);
    $value2 = stripslashes($value2);
    
    $display2 = mysqli_real_escape_string($db, $display2);
    $value2 = mysqli_real_escape_string($db, $value2);
        
    if($display2 == "")
        {
            echo "Please do not leave the Display Value providing service field blank. Please click back on your browser and enter the required details.";
            return;
        }
        
        if($value2 == "")
        {
            echo "Please do not leave the Numerical Value field blank. Please click back on your browser and enter the required details.";
            return;
        }
        
        $addnewresponseoption = "insert into responseoption (servicequestionid, display, value) values ('$questionid', '$display2', '$value2')";
        if($db->query($addnewresponseoption) === TRUE)
        {
            header("Location: editsurvey2.php?id=$serviceid"); 
        } else {
            echo "Error: ".$db->error;
        }
        
}
