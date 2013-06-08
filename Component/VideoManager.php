<?php

namespace meedi\VideoBundle\Component;

use meedi\VideoBundle\Model\BaseVideo;
use meedi\VideoBundle\Providers\IVideoProvider;

class VideoManager
{
    protected $providers = array();

    public function __construct()
    {
    }

    /**
     * 
     * @param string $providerName
     * @return IVideoProvider
     */
    public function getProviderClassFromName($providerName)
    {
        if(array_key_exists($providerName, $this->providers))
            return $this->providers[$providerName];
        return null;
    }

    public function updateVideoFromUrl(BaseVideo $video, $url)
    {
        foreach($this->providers as $provider)
        {
            $videoId = $provider->getVideoIdFromUrl($url);
            if($videoId != null)
            {
                if($provider->isValidVideoId($videoId))
                {
                    $data = $provider->getVideoData($videoId);

                    $video->setProvider($provider)
                          ->setVideoId($videoId)
                          ->setTitle($data['title'])
                          ->setDescription($data['description'])
                          ->setDuration($data['duration'])
                          ->setThumbPath($data['thumbPath']);

                    return $video;
                }

                //Error : VideoId is not valid.
            }
        }
        return null;
        //Error : No provider found.
    }
    
    public function getUrlFromVideo(BaseVideo $video)
    {
            return $video->getProvider()->getVideoUrlFromId($video->getVideoId());
    }
    
    public function matchUrl(IVideoProvider $provider, $url)
    {
        return ($provider->getVideoIdFromUrl($url) != null);
    }

    public function getProviderFromUrl($url)
    {
        foreach($this->providers as $provider)
        {
            if($this->matchUrl($provider, $url))
            {
                return $provider;
            }
        }

        return null;
    }

    public function addProvider(IVideoProvider $provider, $alias)
    {
        $this->providers[$alias] = $provider;
    }
}
?>
