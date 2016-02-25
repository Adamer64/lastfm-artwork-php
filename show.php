<?php
require_once "lastfm/last.php";
require_once "lastfm/stream.php";
$search = (string) $info['track'];
$returned = LastFM::getTrack($search);

echo "<img src=\"";
echo LastFM::getCover($returned[0], $returned[1], 3); // You can use 0-4 for different image sizes
echo "\">";
?>