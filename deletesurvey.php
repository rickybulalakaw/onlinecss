<?php

/* 
 * This page processes command from unitadmin.php
 * This page deletes a survey questionnaire set by deleting the corresponding row in the service table of the clientsatisfaction database.
 * This does not delete the record associated with that service. 
 */

require_once("db.php");

// This page should check the username 

// This page should check that the username is authorized to delete the survey based on the office of the user and if the user is authorized to make such changes. 

if(!isset($_GET['servicei']))
{
    echo "Sorry, this page lacks necessary parameters to display sufficient information.";
    return;
}

$i = $_GET['servicei'];

// This page should check if the service exists in the service table. 
// If yes, proceed with the next line. 

$deleteservice = "DELETE FROM service WHERE id = $i";

if($db->query($deleteservice) === TRUE)
{
    // The delete action should be logged. 
    
    header("Location: unitadmin.php"); 
}


