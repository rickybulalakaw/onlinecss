<?php

// This page should have controls for office based on serviceid

if(!isset($_GET['id']))
{
    echo "Sorry, you are accessing an invalid page.";
    return;
}

$serviceid = $_GET['id'];

require_once("db.php");

$checkserviceid = "select id from service where id = $serviceid";
$resultcheckserviceid = $db->query($checkserviceid);
if($resultcheckserviceid -> num_rows == 0)
{
    echo "Sorry, the service number in this page is not correct.";
    return;
}

?>

<html>
    <head>
        <title>Survey Question Creator Page</title>
    </head>    
    <body>
        <h1>Survey Question Creator Page</h1>
        <form action="addsurveyquestionprocess.php" method ="post" enctype="multipart/form-data">
            <input name ="serviceid" value="<?php echo $serviceid ?>" hidden>
            <b>Question</b><br />
              
            Enter the question in a clear manner<br /> 
            <textarea rows="3" cols="50" name="question"  maxlength="1500" >e.g., How would you rate this service in terms of punctuality? </textarea><br />
            <br />
            
            <b>Question Type</b><br />
            Is the expected response for this question a number with an adjectival equivalent or a narrative?<br />
            <select name="questiontype">
                <option value=""></option>
                <option value="Narrative">Narrative</option>
                <option value="Number">Number</option>
            </select>
            
            <br /><br />
            
            <b>Please check the name of the service before clicking "Create" below</b><br /><br />
            <input name="addquestion" type="submit" value="Add Question">
            <br />
            <br />
            <a href='index.php'>Go to the Home page</a>
        </form>            
    </body>
</html>