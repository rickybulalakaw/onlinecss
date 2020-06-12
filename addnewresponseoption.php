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

$servicequestionid = $_GET['i'];

// This page should check if the user is allowed based on the office. 

require_once("db.php");

// This gets the service id

$getserviceid = "select Serviceid from servicequestion where id = $servicequestionid";
$processgetserviceid = $db->query($getserviceid);
$dbserviceiddata = $processgetserviceid->fetch_assoc();
$serviceid = $dbserviceiddata['Serviceid'];

echo "This is for adding a response option to Question Number $servicequestionid of Service $serviceid.";

// This will be a form

echo "<br /><br >";
//echo "This is not yet working. Click Return on your browser.<br />";

echo "<form  action='addnewresponseoptionprocess.php' method = 'post' enctype='multipart/form-data'>";

echo "<input  name='questionid' value='$servicequestionid' hidden>";
echo "<input  name='serviceid' value='$serviceid' hidden>";

echo "Display Value <input type='text' name='display' placeholder='e.g., Outstanding' >  <br /><br />";
echo "Numerical Value <input type='number' name='value'>  <br />";

echo "<br />";

echo "<br /><input type='submit' name='submitnewresponseoption' value='Record'><br /><br />";
echo "</form>";

return;