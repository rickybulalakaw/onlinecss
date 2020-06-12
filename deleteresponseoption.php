<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!isset($_GET['i']))
{
    echo "Sorry, the link is not valid. Click Return on your browser.";
    return;
    
}

$questionresponseoptionid = $_GET['i'];

// This page should check if the user is allowed based on the office. 

require_once("db.php");

// This sequence checks if the question exists in the database. 

$checkresponse = "select id from responseoption where id = $questionresponseoptionid";
$processcheckresponse = $db->query($checkresponse);
if ($processcheckresponse -> num_rows != 1)
{
    echo "Sorry, that response option does not exists in the database. Click Return on your browser.";
    return;
}

// This sequence gets the service id of the response option

$getserviceid = "select servicequestion.Serviceid from servicequestion, responseoption where responseoption.servicequestionid = servicequestion.id "
        . "and responseoption.id = $questionresponseoptionid";
$processgetserviceid = $db->query($getserviceid);
$dbserviceiddata = $processgetserviceid->fetch_assoc();
$serviceid = $dbserviceiddata['Serviceid'];


// This sequence deletes the question in the database. 

$deleteresponseoption = "delete from responseoption where id = $questionresponseoptionid";
if($db->query($deleteresponseoption) === TRUE)
{
    header("Location: editsurvey2.php?id=$serviceid"); 
}