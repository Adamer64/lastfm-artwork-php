<?php


function getInfo() {
	$offline_message = "Offline";
	$server = "http://localhost:8000/stream.xspf"; // Your stream URL goes here
	$xml = @simplexml_load_file($server);
	if($xml) $stream = (string) $xml->trackList->track->title;

	if($xml === false) echo $offline_message;
	else return $stream;
}
$offline_message = "Offline";
$stream = getInfo();

if($stream != $offline_message) { // If stream isn't down
	$split = explode(" - ", $stream);
	$info['artist'] = isset($split[0]);
	$info['track'] = isset($split[1]);
} else {
	$info['artist'] = "-";
	$info['track'] = "-";
}


?>
