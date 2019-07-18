<?php
  $output=shell_exec("rm -r photos/* ");
  $output=shell_exec("unzip uploads/sample.zip -d photos/");
 echo "<script type='text/javascript'>alert('Lets Analyze!!!!!');
                                window.location.href='chart.php';</script>";
?>
