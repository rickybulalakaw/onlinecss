<?php

/* 
 * THIS FILE IS NO LONGER NEEDED. The function of this page is taken by unitadmin.php
 * This page selects a service which will be sent to a client. 
 * The services to be displayed should be limited to the unit of the person signed in.
 */

header("Location: unitadmin.php"); 

require_once ("db.php");

echo "<p align='center'><b>Notes for programmer: This page should only display the services of the unit of the person signed in.</b></p>";

echo "Select the service that you will send a survey for:<br /><br />";

$selectservices = "select id, Servicename from service where status = 'Active' order by Servicename ASC";
$processselectservices = $db->query($selectservices);

if($processselectservices -> num_rows >= 1){
    echo "<table border='1' style='width:100%'>";
    echo "<tr>";
    echo "<td style='background-color:#87CEFA' align='center'>Service </td>";
    echo "<td style='background-color:#87CEFA' align='center'>Action</td>";    
    echo "</tr>";
    $i = 1;
    while($row2 = $processselectservices->fetch_assoc())
    {
        
        echo "<tr>";
        echo "<td>$i. ".$row2['Servicename']." </td>";
        echo "<td align='center'> <a href='editsurvey2.php?id=".$row2['id']."'>Edit this survey form</a> </td>";
        echo "</tr>";
        $i++;
    }
    echo "</table>";
    
       
}