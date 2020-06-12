<?php

/* 
 * This page displays immediately the type of service the page will create a link for.
 * This page gets data about the service rendered and the client. 
 * At the end of this process, it will send a link to a CSS form for the specific service.  
 */

// This page should check the user
// This page should check that the user is authorized to create this link based on the office of the user.

if(!isset($_GET['servicei']) || $_GET['servicei'] == "")  
{
    echo "Sorry, this page lacks necessary parameters to display sufficient information.";
    return;
} 

$i = $_GET['servicei'];

require_once ("db.php");

//echo "Success";

// This page gets the name of the service rendered based on the serviceid

$getservicename = "select Servicename from service where id=$i";
$processgetservicename = $db->query($getservicename);
if($processgetservicename -> num_rows >= 1)
{
    $row2 = $processgetservicename->fetch_assoc();
    $servicename = $row2['Servicename']; 
} else {
    echo "Sorry, this incorrect information has been used in this website. Please click Back on your browser and try another link.";
    return;
}




echo "<p align='center'>You are creating a survey link for <b>$servicename</b></p>";

echo "<p align>Please enter the pertinent data for the service rendered. Unless otherwise indicated, <b><i>all fields are required</i></b>.</p>";

echo "<form action='createsurveylinkprocess.php' method ='post' enctype='multipart/form-data'>";

echo "<input name='serviceid' type='number' value = '$i' hidden>";

echo "<b>Type of Client</b>: <br />"; 
echo "<select name='internalexternal'>";
echo "<option value=''></option>";
echo "<option value='Internal'>Internal</option>";
echo "<option value='External'>External</option>";
echo "</select><br/><br/>";


echo "<b>Name of Client</b>: <br />"; 
echo "<input name='name' type='text'><br /><br />";

echo "<b>Date Service Completed</b>: <br />"; 
echo "<input name='date' type='date'><br /><br />";


echo "<b>Email Address</b>: <br />"; 
echo "<input name='emailid' type='email'><br />";
echo "<i>If the client is a PMS employee who does not have an email address, request that client provide either an office email address or the email address of another employee in his/her office.<br/>"
. "If the client is not a PMS employee and does not have an email address, use your office's designated kiosk email address.  </i><br /><br />";



echo "<b>Service Request Details</b>: <br/>"; 
echo "<textarea rows='3' cols='50' name='servicerequestdetails'  maxlength='1000'></textarea><br />";
echo "<i>This field should contain any information included in the service request as submitted by the client.</i><br /><br />";

echo "<b>Service Rendered Remarks</b>: <br />"; 
echo "<textarea rows='3' cols='50' name='servicerenderedremarks'  maxlength='1000'></textarea><br />";
echo "<i>This field should contain any feedback from your unit when the service was rendered.</i><br /><br />";
echo "<input name='servicetransactionrequest' type='submit' value='Create survey link'>";

// Upon post, the processing will involve the creation of an md5 has of the email address, name, and date, which will be included in the link to make it unique and not vulnerable to guessing. 