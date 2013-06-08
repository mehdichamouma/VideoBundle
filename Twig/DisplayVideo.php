<?php
namespace meedi\VideoBundle\Twig;

class DisplayVideo extends \Twig_Extension
{
    
    public $videoManager;
    
    public function __construct(\meedi\VideoBundle\Component\VideoManager $videoManager) {
        $this->videoManager = $videoManager;
    }
    
    public function getName()
    {
        return 'meediDisplayVideo';
    }
	
    public function getFunctions()
    {
        return array(
            'displayVideo' => new \Twig_Function_Method($this, 'displayVideo') 
        );
    }
    
    /**
     * 
     * @param type $text
     * @return boolean
     */
    public function displayVideo(\meedi\VideoBundle\Model\BaseVideo $video, $width = null, $height = null)
    {    
        $provider = $video->getProvider();
        if($provider != null)
        {
            echo $provider->GetEmbedCodeFromVideoId($video->getVideoId(), $width, $height);
        }
    }
}