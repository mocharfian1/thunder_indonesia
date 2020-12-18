<?php
	
	$out = array();
	exec("cd .. && ls", $out);
	foreach($out as $line) {
	    echo $line;
	}

?>