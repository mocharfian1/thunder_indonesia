<?php
	
	$out = array();
	exec("ls", $out);
	foreach($out as $line) {
	    echo $line;
	}

?>