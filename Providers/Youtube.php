<?php

namespace meedi\VideoBundle\Providers;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of YoutubeProvider
 *
 * @author Mehdi
 * 
 * @property string $videoId
 * @property DomDocument $xmlDom
 */
class Youtube implements IVideoProvider{
    
    const regex = '#^(http(s)?:\/\/)?(www\.)?youtu(be)?\.([a-z])+\/(watch(.*?)(\?|\&)v=)?(.*?)(&(.)*)?$#';

    public static function getEmbedCodeFromVideoId($videoId, $width = null, $height = null) {
        
        if($width != null) {
            $width = 'width="'.$width.'"';
        }
        if($height != null){
            $height = 'height="'.$height.'"';
        }
        
        return '<iframe '.$width.' '.$height.' src="http://www.youtube.com/embed/'.$videoId.'?theme=light&color=white&autohide=1&wmode=transparent" frameborder="0" allowfullscreen></iframe>';
    }

    public static function getProviderUrl() {
        return 'http://www.youtube.com/';
    }


    public static function getProviderName() {
        return 'youtube';
    }

    public static function getVideoData($videoId) {
        $videoData = array();
        
        $videoData['videoId'] = $videoId;
        
        $dom = new \DOMDocument();
        $dom->load('http://gdata.youtube.com/feeds/api/videos/'.$videoId);
        
        $videoData['title'] = $dom->getElementsByTagName('title')->item(0)->nodeValue;
        $videoData['description'] = $dom->getElementsByTagName('description')->item(0)->nodeValue;
        $videoData['duration'] = $dom->getElementsByTagName('duration')->item(0)->getAttribute('seconds');
        $videoData['thumbPath'] = 'http://i.ytimg.com/vi/'.$videoId.'/hqdefault.jpg';
        
        return $videoData;
    }

    public static function getVideoUrlFromId($videoId) {
        return 'http://www.youtube.com/watch?v='.$videoId;
    }

    public static function isValidVideoId($videoId)
    {
        $headers = get_headers('http://gdata.youtube.com/feeds/api/videos/' . $videoId);
        if (!strpos($headers[0], '200')) {
            return false;
        }
        return true;
    }

    public static function getVideoIdFromUrl($url)
    {
        if(preg_match(self::regex, $url))
        {
            return preg_replace(self::regex, '$9', $url);
        }
        return null;
    }
}

?>
