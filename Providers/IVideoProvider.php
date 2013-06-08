<?php

namespace meedi\VideoBundle\Providers;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Mehdi
 */
interface IVideoProvider {
       
    public static function getVideoIdFromUrl($url);

    public static function getEmbedCodeFromVideoId($videoId, $width, $height);
    
    public static function getProviderUrl();
    
    public static function getProviderName();
    
    public static function getVideoUrlFromId($videoId);

    public static function getVideoData($videoId);
    
    public static function isValidVideoId($videoId);
}

?>
