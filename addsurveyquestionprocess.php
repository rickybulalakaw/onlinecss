<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once ("db.php");

if(isset($_POST['addquestion']))
{
    $serviceid = strip_tags($_POST['serviceid']);
    $question = strip_tags($_POST['question']);
    $questiontype = strip_tags($_POST['questiontype']);
    
    $serviceid = stripslashes($serviceid);
    $question = stripslashes($question);
    $questiontype = stripslashes($questiontype);
    
    $serviceid = mysqli_real_escape_string($db, $serviceid);
    $question = mysqli_real_escape_string($db, $question);
    $questiontype = mysqli_real_escape_string($db, $questiontype);
        
    if($question == "")
        {
            echo "Please do not leave the Question field blank. Please click back on your browser and enter the required details.";
            return;
        }
        
        if($questiontype == "")
        {
            echo "Please do not leave the Question Type field blank. Please click back on your browser and enter the required details.";
            return;
        }
        
        $addquestion = "insert into servicequestion (Question, Serviceid, Type) values ('$question', '$serviceid', '$questiontype')";
        if ($db->query($addquestion) === TRUE )
        {
            
            if($questiontype === 'Narrative')
            {
                header("Location:editsurvey2.php?id=$serviceid"); 
            } else {
                
                //Sequence selects question id from database for reference
                
                $selectquestionid = "select id from servicequestion where Question = '$question' order by timestamp desc limit 1";
                $resultselectquestionid = $db->query($selectquestionid);
                $dataresultselectquestionid = $resultselectquestionid->fetch_assoc();
                $dbquestionid = $dataresultselectquestionid['id'];
                
                header("Location:addresponseoptions.php?qid=$dbquestionid&&serviceid=$serviceid");
            }
            
            
        } else {
            
            echo "Error: ".$db->error;
            
        }
        
    
    
}
