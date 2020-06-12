<?php

/* 
 * This page deletes question in the survey template for a specific service.
 */

if (!isset($_GET['i']))
{
    echo "Sorry, the link is not valid. Click Return on your browser.";
    return;
    
}


if (!isset($_GET['serviceid']))
{
    echo "Sorry, the link is not valid. Click Return on your browser.";
    return;
    
}
 

$questionid = $_GET['i'];
$serviceid = $_GET['serviceid'];

// This page should check if the user is allowed based on the office. 

require_once("db.php");

// This sequence checks if the question exists in the database. 

$checkquestion = "select id from servicequestion where id = $questionid";
$processcheckquestion = $db->query($checkquestion);
if ($processcheckquestion -> num_rows != 1)
{
    echo "Sorry, that question does not exists in the database. Click Return on your browser.";
    return;
}


// This sequence deletes the question in the database. 

$deletequestion = "delete from servicequestion where id = $questionid";
if($db->query($deletequestion) === TRUE)
{
    header("Location: editsurvey2.php?id=$serviceid"); 
}




