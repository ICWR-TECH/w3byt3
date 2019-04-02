<?php
error_reporting(0);
// W3byt3 - Anti Malware Website
// Copyright (c)2019 - Afrizal F.A - ICWR-TECH
$dbscan = file_get_contents("https://raw.githubusercontent.com/ICWR-TECH/w3byt3/master/analyze-malware.db");
$split = explode("^", $dbscan);
function scand($dir, $scn){
	$files = array_diff(scandir($dir), array('.', '..'));
		foreach($files as $file) {
			if(is_dir($dir."/".$file)){
				scand($dir."/".$file, $scn);
			} else {
			    $namef = $dir."/".$file;
                $file = file_get_contents($namef);
                    if(preg_match("/$scn/", $file)) {
                        unlink($namef);
                    }
		    }
	    }
}
foreach($split as $scan) {
    scand($argv[1], $scan);
}
?>
