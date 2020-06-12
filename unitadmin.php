<?php

/* 
 * This page displays unit-level admin tools.
 * This page should be limited to personnel with CSS unit admin rights
 * This page should only display surveys / serviceids owned by the unit 
 */


require_once ("db.php");

echo "<p align='center'><b>Notes for programmer: This page should: <br /> 1) Check that the user is a Unit CSS Admin and <br /> 2) Display only the services of the unit of the person signed in.</b></p>";

echo "<p align='center'>Look for the service that you want to administer and click the appropriate link for the action you want to do.</p>";

$selectservices = "select id, Servicename from service where status = 'Active' order by Servicename ASC";
$processselectservices = $db->query($selectservices);

if($processselectservices -> num_rows >= 1){
    echo "<table border='1' style='width:100%'>";
    echo "<tr>";
    echo "<td style='background-color:#87CEFA' align='center'>Service </td>";
    echo "<td style='background-color:#87CEFA' align='center' colspan='3'>Action</td>";    
    echo "</tr>";
    $i = 1;
    while($row2 = $processselectservices->fetch_assoc())
    {
        
        echo "<tr>";
        echo "<td>$i. ".$row2['Servicename']." </td>";
        echo "<td align='center'> <a href='editsurveytitle.php?id=".$row2['id']."'>Edit survey name <br/><font color='red'> (not yet working)</font></a> </td>";
        echo "<td align='center'> <a href='editsurvey2.php?id=".$row2['id']."'>Edit survey questions<br/></a> </td>";
        echo "<td align='center'> <a href='deletesurvey.php?servicei=".$row2['id']."'>Delete survey<br/></a> </td>";
        echo "</tr>";
        $i++;
    }
    echo "</table>";
    
       
}
echo "<p align='center'><a href='index.php'>Go to the Homepage</a></p>";