<br />
<?php  
  date_default_timezone_set('Europe/Berlin');
  $heute = time();
  
  if(isset($_POST["datetimepicker"])){
      $datetimepicker = $_POST["datetimepicker"];
      $a_day = explode(".",explode(" ",$datetimepicker)[0])[0];
      $a_month = explode(".",explode(" ",$datetimepicker)[0])[1];
      $a_year = explode(".",explode(" ",$datetimepicker)[0])[2];
      $a_hour = explode(":", explode(" ",$datetimepicker)[1])[0];
      $a_minute = explode(":", explode(" ",$datetimepicker)[1])[1];
  }else{
      $a_day = date("j",$heute);
      $a_month = date("n",$heute);
      $a_year = date("Y",$heute);
      $a_hour = date("H",$heute);
      $a_minute = date("i",$heute);
  }
  
  if(isset($_POST["datetimepicker2"])){
      $datetimepicker2 = $_POST["datetimepicker2"];
      $i_day = explode(".",explode(" ",$datetimepicker2)[0])[0];
      $i_month = explode(".",explode(" ",$datetimepicker2)[0])[1];
      $i_year = explode(".",explode(" ",$datetimepicker2)[0])[2];
      $i_hour = explode(":", explode(" ",$datetimepicker2)[1])[0];
      $i_minute = explode(":", explode(" ",$datetimepicker2)[1])[1];
  }else{
      $i_day = date("j",$heute);
      $i_month = date("n",$heute);
      $i_year = date("Y",$heute);
      $i_hour = date("H",$heute);
      $i_minute = date("i",$heute);
  }
  
  $start = mktime($a_hour,$a_minute,0,$a_month,$a_day,$a_year);
  $jetzt = date("d.m.Y H:i",$start);

  if(isset($_POST["hours"])){$hours = $_POST["hours"]+0;}else{$hours = 0;}
  if(isset($_POST["minutes"])){$minutes = $_POST["minutes"]+0;}else{$minutes = 0;}
  if(isset($_REQUEST["submit1"])){$erg = date("d.m.Y H:i",($start + $hours*3600 + $minutes*60));}
  if(isset($_REQUEST["submit2"])){$zeitpunkt = mktime($i_hour,$i_minute,0,$i_month,$i_day,$i_year);$zeitpunkt_in_S = ($zeitpunkt-$start)/60/60;}
  if(isset($_REQUEST["reset"])){header("Location: ".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]);}
?>
<link rel="stylesheet" type="text/css" href="datetimepicker/jquery.datetimepicker.css"/ >
<script src="datetimepicker/jquery.js"></script>
<script src="datetimepicker/jquery.datetimepicker.js"></script>

<fieldset style="<?php if(isset($_REQUEST["submit1"]) || isset($_REQUEST["submit2"])){echo "width: 450px;";}else{echo "width: 310px;";}; ?>" class="fieldset-show">
<legend class="legend-show">Start</legend>
<form action="" method="POST" >
	Startzeitpunkt: <input style="margin-top: 3px;" name="datetimepicker" id="datetimepicker" value="<?php echo $a_day.".".$a_month.".".$a_year."&nbsp;".$a_hour.":".$a_minute; ?>" type="text" >
</fieldset>
<br />
<fieldset style="<?php if(isset($_REQUEST["submit1"]) || isset($_REQUEST["submit2"])){echo "width: 450px;";}else{echo "width: 310px;";}; ?>" class="fieldset-show">
<legend class="legend-show">Ziel</legend>
<table border="0">
	<tr>
		<td width="315">
					<table border="0">
                      <tr><td>Stunden: </td><td><input style="margin-top: 3px;" value="<?php echo $hours; ?>" type="number" name="hours" /></td></tr>
                      <tr><td>Minuten: </td><td><input style="margin-top: 3px;" value="<?php echo $minutes; ?>" type="number" name="minutes" /></td></tr>
                      <tr><td></td><td><button class="btn btn-small" type="submit" name="submit1" >Rechnen</button></td></tr>
					</table>
					<br /><br />
					<table border="0">
						<tr><td><input style="margin-top: 3px;" name="datetimepicker2" id="datetimepicker2" value="<?php echo $i_day.".".$i_month.".".$i_year."&nbsp;".$i_hour.":".$i_minute; ?>" type="text" ></td></tr>
						<tr><td><button class="btn btn-small" type="submit" name="submit2" >Rechnen</button></td></tr>
					</table>
		</td>
		<td width="180">							
			<?php
				if(isset($_REQUEST["submit1"]) || isset($_REQUEST["submit2"])){
					echo "<div style=\"border: 1px solid #ccc; padding: 20px; width: 110px;\"><table border=\"0\">";
					if(isset($_REQUEST["submit1"])){
						echo "<tr><td></td><td>".$jetzt."</td></tr>";
						echo "<tr><td></td><td>+ ".$hours." Stunden</td></tr>";
						echo "<tr><td></td><td style=\"border-bottom: 1px solid;\">+ ".$minutes." Minuten</td></tr>";		
						echo "<tr><td></td><td>".$erg."</td></tr>";
					}
					if(isset($_REQUEST["submit2"])){
						echo "<tr><td></td><td>".$jetzt."</td></tr>";
						echo "<tr><td></td><td style=\"border-bottom: 1px solid;\">".date("d.m.Y H:i",$zeitpunkt)."</td></tr>";
						echo "<tr><td></td><td>".round($zeitpunkt_in_S,2)." Stunden</td></tr>";
					}
					echo "</table></div><button style=\"width: 152px;\" class=\"btn btn-small\" type=\"submit\" name=\"reset\" >Reset</button>";
				}
			?>          	
		</td>
	</tr>
</table>
</form>
<br />
</fieldset>
<script>
jQuery('#datetimepicker').datetimepicker({
  format:'d.m.Y H:i',
  lang:'de'
});
jQuery('#datetimepicker2').datetimepicker({
  format:'d.m.Y H:i',
  lang:'de'
});
</script>
<br /><br />