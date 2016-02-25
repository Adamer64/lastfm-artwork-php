<?php
class LastFM {

	const API = "your_key_here"; // Insert your API Key here
		
	public static function getCover($artist, $album, $size) {
		$return_image = "";
		$nocover = "nocover.jpg"; // If there is no cover found, show this image
		$artist = urlencode($artist);
        $album = urlencode($album);
        $xml = "http://ws.audioscrobbler.com/2.0/?method=album.getinfo&artist={$artist}&album={$album}&api_key=" . self::API;
		$xml = @file_get_contents($xml);
		
		if(!$xml) {
                return $nocover;
                }
				
        $xml = new SimpleXMLElement($xml);
        $xml = $xml->album;
        $xml = $xml->image[$size];
		return (!$return_image) ? $xml : $xml;
	
	
	}
		
	public static function getTrack($name) {
			$nocover = "nocover.jpg"; // If there is no cover found, show this image
			$name = urlencode($name);
			
			$xml = "http://ws.audioscrobbler.com/2.0/?method=track.search&track={$name}&api_key=" . self::API;
			$xml = @file_get_contents($xml);
			
			if(!$xml) {
				return $nocover;
				}
			
			@$xml = new SimpleXMLElement($xml);
			$xml = $xml->results;
			$xml = $xml->trackmatches;
			if($xml) $xml = $xml->track[0];
			if(!$xml) {
				return $nocover;
				}
			$artist = $xml->artist;
			$track = $xml->name;
			
			$artist = urlencode($artist);
			$track = urlencode($track);
						
			$xml = "http://ws.audioscrobbler.com/2.0/?method=track.getinfo&track={$track}&artist={$artist}&api_key=" . self::API;
			$xml = @file_get_contents($xml);
			
			if(!$xml) {
				return $nocover;
				}
			
			$xml = new SimpleXMLElement($xml);
			$xml = $xml->track;

			
			return array((string) $xml->artist->name, (string) $xml->album->title);
			
		}
}

