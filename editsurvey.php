<?php

// This page should have controls for office based on serviceid

if(!isset($_GET['id']))
{
    echo "Sorry, you are accessing an invalid page.";
    return;
}

$serviceid = $_GET['id'];

require_once("db.php");

$checkserviceid = "select id, Servicename from service where id = $serviceid";
$resultcheckserviceid = $db->query($checkserviceid);
if($resultcheckserviceid -> num_rows == 0)
    
{
    echo "Sorry, the service number in this page is not correct.";
    return;
} 

$dbdataservice = $resultcheckserviceid->fetch_assoc();
$servicename = $dbdataservice['Servicename'];

// This page should check if the user is allowed to access this page based on office
    

$getquestions = "select id from servicequestion where Serviceid = '$serviceid' and status = 'Active'";
$result1getquestions = $db->query($getquestions);
if($result1getquestions -> num_rows == 0)
{
    echo "This survey form has no questions yet.<br /><br />";
    echo "You may add questions <a href='addsurveyquestion.php?id=$serviceid'>here</a>.<br /><br />";
} else {
    //add questions here
    
    echo "Below are the questions for <b>$servicename</b>:<br /><Br />";
    
    $fetchquestions = "Select id, Question, Type from servicequestion where Serviceid = $serviceid and status = 'Active' order by timestamp asc";
    $resultfetchquestions = $db->query($fetchquestions);
    
    
    echo "<table border='1' style='width:100%'>";
    echo "<tr><td style='background-color:#87CEFA' align='center'>Question</td><td style='background-color:#87CEFA' align='center'>Question Type</td><td style='background-color:#87CEFA' align='center' colspan='3'>Action</td></tr>";
    while ($dbdata1 = $resultfetchquestions->fetch_assoc())
    {

        echo "<tr><td>".$dbdata1['Question']."</td>";
        echo "<td align='center'>".$dbdata1['Type']."</td>";
        echo "<td style='background-color:#87CEFA' align='center'><a href='editquestion.php?i=".$dbdata1['id']."'>Edit Question</a></td>";
        echo "<td style='background-color:#87CEFA' align='center'><a href='deletequestion.php?i=".$dbdata1['id']."'>Delete</a></td>";
        echo "<td style='background-color:#87CEFA' align='center'><a href='editresponseoptions.php?i=".$dbdata1['id']."'>Edit response options (if Number) (not yet working) </a></td></tr>";
    

    
    }
    echo "</table>";
    echo "<br /><br />";
    echo "You may add questions <a href='addsurveyquestion.php?id=$serviceid'>here</a>.<br /><br />";
    
           
    
    
}