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
    
    echo "Below are the questions for client satisfaction surveys on <b>$servicename</b>:<br /><Br />";
    
    $fetchquestions = "Select id, Question, Type from servicequestion where Serviceid = $serviceid and status = 'Active' order by timestamp asc";
    $resultfetchquestions = $db->query($fetchquestions);
    
    
    //echo "<table border='1' style='width:100%'>";
    //echo "<tr><td style='background-color:#87CEFA' align='center'>Question</td><td style='background-color:#87CEFA' align='center'>Question Type</td><td style='background-color:#87CEFA' align='center' colspan='3'>Action</td></tr>";
    $i = 1; 
    while ($dbdata1 = $resultfetchquestions->fetch_assoc())
    {
 
        echo "Question No. <b>$i. ".$dbdata1['Question']."</b> <br /><a href='editquestion.php?i=".$dbdata1['id']."'>Edit Question <font color='red'> (not yet working)</font> </a> <br /> <a href='deletequestion.php?i=".$dbdata1['id']."&&serviceid=$serviceid'>Delete Question </a><br /><br /><br />";
        
        if($dbdata1['Type'] == "Narrative")
        {
            echo "Response:<br /><br />";
            echo "text box<br /><br /><br />";
        } else {
            
                $selectresponseoptions = "select id, display, value from responseoption where servicequestionid = ".$dbdata1['id']." order by value asc";
                $processselectresponseoptions = $db->query($selectresponseoptions);
                
                $a = "a";
                while ($dbresponseoption = $processselectresponseoptions -> fetch_assoc())
                {
                    echo $a.". ".$dbresponseoption['value']." - ".$dbresponseoption['display']." <br /><a href='editresponseoption.php?i=".$dbresponseoption['id']."'>Edit response option<font color='red'> (not yet working)</font></a> <br /> <a href='deleteresponseoption.php?i=".$dbresponseoption['id']."'>Delete response option<font color='red'> (not yet working)</font></a><br /><br />";
                    
                    $a++;
                    
                }
                echo "<a href='addnewresponseoption.php?i=".$dbdata1['id']."'>Add response options <font color='red'>(not yet working)</font> </a>";
                echo "<br /><br /><br />";
            }
        
        
              
        //echo "<tr><td>$i. ".$dbdata1['Question']."</td>";
        //echo "<td align='center'>".$dbdata1['Type']."</td>";
        //echo "<td style='background-color:#87CEFA' align='center'><a href='editquestion.php?i=".$dbdata1['id']."'>Edit Question</a></td>";
        //echo "<td style='background-color:#87CEFA' align='center'><a href='deletequestion.php?i=".$dbdata1['id']."'>Delete</a></td>";
        //echo "<td style='background-color:#87CEFA' align='center'><a href='editresponseoptions.php?i=".$dbdata1['id']."'>Edit response options (if Number) (not yet working) </a></td></tr>";
    
        $i++;

    
    }
    //echo "</table>";
    echo "<br /><br />";
    
    
    echo "You may add questions <a href='addsurveyquestion.php?id=$serviceid'>here</a>.<br /><br />";
    
           
    
    
}