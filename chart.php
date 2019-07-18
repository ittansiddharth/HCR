<?php require 'vendor/autoload.php'; // include Composer's autoloader

$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->test->text;

$cursor = $collection->find();
$pos=0;
$neg=0;
$neutral=0;
foreach($cursor as $document){
        if ($document["score"]=="P")
	{
	$pos+=1;
	}
	else if($document["score"]=="N")
        {
        $neg+=1;
        }
	else if($document["score"]=="NONE")
        {
        $neutral+=1;
        }


}
 ?> 
<!DOCTYPE HTML> 
<html>
 <head> 
     <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans'>

      <link rel="stylesheet" href="css/style.css">

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> <script 
type="text/javascript"> window.onload = function () {
	var chart = new CanvasJS.Chart("chartContainer", {
		title:{
			text: "Sentiment Results"
		},
		data: [
		{
			// Change type to "doughnut", "line", "splineArea", etc.
			type: "column",
			dataPoints: [
				{ label: "POSITIVE", y: <?php echo $pos; ?>  },
				{ label: "NEUTRAL", y: <?php echo $neutral; ?>  },
				{ label: "NEGATIVE", y: <?php echo $neg; ?>  }
			]
		}
		]
	});
	chart.render();
}
</script> </head> 
<body class="newbody" background="white">
 <div id="chartContainer" style="height: 400px; width: 70%; margin:100px;"></div>
<div class="intro">
<center>
<h3>SENTENCES ANALYZED</h3>
<table cellspacing="10">
<tr>
<td><b>Sr.no</b></td><td><b>Recognised Text</b></td><td><b>Sentiment Score</b></td><td><b>Link</b></td>
</tr>
<?php require 'vendor/autoload.php'; // include Composer's autoloader

$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->test->text;

$cursor = $collection->find();
$count=1;
$mail_result="Recognised Sentences:\n";
foreach($cursor as $document){
      echo "<tr>";
       echo "<td>".$count."</td> <td>".$document["Text"]."</td> <td>".$document["score"]."</td> <td><a href=\"photos/".$document["name"]."\">"."view file"."</a></td><br>";
       $mail_result.=$count.". ".$document["Text"].". ".$document["score"]."\n";
	$count+=1;
      echo "</tr>";
}
 /*$email_id="alsosrishtimaitra@gmail.com";
 $mail_ee='python mail.py '.$email_id.' '.$mail_result;
 //echo $mail_ee;
 $command = escapeshellcmd($mail_ee);
 $output = shell_exec($command);
*/
?>
</table>
</div>
 </body>
</html>
