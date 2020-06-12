<?php

/* 
 * This page processes POST data from addresponseoptions.php
 */

require_once ("db.php");

// this page should check for session id

// this page should check for office of user



if(isset($_POST['submitresponseoptions']))
{
    $questionid = $_POST['questionid'];
    $serviceid = $_POST['serviceid'];
    
    if(!empty($_POST['display1']) && !empty($_POST['value1']) && 
        is_array($_POST['display1']) && is_array($_POST['value1']) && 
        count($_POST['display1']) === count($_POST['value1'])
        )
        
    {
        $display1_array = $_POST['display1'];
        $value1_array = $_POST['value1'];
        for ($i = 0; $i < count($display1_array); $i++)
        
        {
            $display1 = mysqli_real_escape_string($db, $display1_array[$i]);
            $value1 = mysqli_real_escape_string($db, $value1_array[$i]);
            
            $display1 = stripslashes($display1);
            $value1 = stripslashes($value1);
                        
            $display1 = strip_tags($display1);
            $value1 = strip_tags($value1);
            
            
            
            if($display1 == "")
        
                {
            
                echo "Please do not leave the Display fields blank. Please click back on your browser and enter the required details.";            
                return;        
                
                }
                
                if($value1 == "")
        
                {
            
                echo "Please do not leave the Display fields blank. Please click back on your browser and enter the required details.";            
                return;        
                
                }
                
                $addresponseoption = "INSERT INTO responseoption (servicequestionid, display, value) VALUES ('$questionid', '$display1', '$value1')";
                $db->query($addresponseoption);
            
        }
        
        
        
        
    }
    
    header("Location: editsurvey2.php?id=$serviceid"); 
    
}