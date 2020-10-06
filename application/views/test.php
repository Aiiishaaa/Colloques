<?php
//print_r($db);
$counter = 0 ;
foreach ($db->getDatabase() as $item) {
	//echo $item->getCreationDateYear() . " ". $item->getCreationDateFull()."<br>";
	//echo ($counter++)." : " ;
	var_dump($item->getParticipants()) ;
	//echo "<br>" ;
}
?>
