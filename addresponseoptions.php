<?php

/* 
 * This page starts entering of numerical options for surveys. 
 * $_GET['qid'] identifies the id from servicequestion table
 * $_GET['serviceid'] identifies the id from service table
 * $_GET['qno'] identifies the number of options to display in this page, for entering of data
 */

if(!isset($_GET['qid']))
{
    echo "Sorry, you are accessing an invalid question.";
    return;
}

$questionid = $_GET['qid'];

// check qid if it is linked to correct service id

require_once("db.php");

$serviceid = $_GET['serviceid'];

$checkquestiontoservice = "select id from servicequestion where Serviceid='$serviceid' and id='$questionid'";
$resultcheckquestiontoservice = $db->query($checkquestiontoservice);
if($resultcheckquestiontoservice -> num_rows == 0)
{
    echo "Sorry, the question is not linked to the correct service.<br /><br />";
    echo "You can click Back on your browser to try again.";
    return;
}

// Check if the question is quantitative 

$checkquestionquantitative = "select Type from servicequestion where id = '$questionid'";
$resultcheckquestionquantitative = $db->query($checkquestionquantitative);
$dataprocess = $resultcheckquestionquantitative -> fetch_assoc();
$dbtype = $dataprocess['Type'];
if($dbtype != 'Number')
{
    echo "This question is classified as a Narrative-type response. You cannot enter specific response options.";
    return;
}


echo "Congratulations. You can enter response options for Question Number $questionid for service id number $serviceid <br /><br />";

if(!isset($_GET['qno']))
{
    echo "This is working <br /><br />";
    
    echo "Please click how many response options do you want for this question:<br /><br />";
    echo "<a href='addresponseoptions.php?qid=$questionid&&serviceid=$serviceid&&qno=2'>Two (2) options</a><br />";
    echo "<a href='addresponseoptions.php?qid=$questionid&&serviceid=$serviceid&&qno=3'>Three (3) options</a><br />";
    echo "<a href='addresponseoptions.php?qid=$questionid&&serviceid=$serviceid&&qno=4'>Four (4) options</a><br />";
    echo "<a href='addresponseoptions.php?qid=$questionid&&serviceid=$serviceid&&qno=5'>Five (5) options</a><br />";
    
    
    return;
}

$qno = $_GET['qno'];



$fetchquestionid = "select id from servicequestion where id = $questionid";
$resultquestionid = $db->query($fetchquestionid);
if($resultquestionid -> num_rows == 0)
{
    echo "Sorry, the service question number in this page is not correct.";
    return;
}

echo "This question has $qno response options.<br /><br />";

echo "<form  action='addresponseoptionsprocess.php' method = 'post' enctype='multipart/form-data'>";

// while ($row = $result15a->fetch_assoc()){


$i = 1;
while ($i <= $qno)
{
    echo "Option $i<br />";
    
    echo "<input  name='questionid' value='$questionid' hidden>";
    echo "<input  name='serviceid' value='$serviceid' hidden>";
            
    echo "Display Value <input type='text' name='display1[]' placeholder='e.g., Excellent' >  <br /><br />";
    echo "Numerical Value <input type='number' name='value1[]'>  <br />";
    echo "<br />";
   
    ++$i;
}

echo "<br /><input type='submit' name='submitresponseoptions' value='Record'><br /><br />";
echo "</form>";





