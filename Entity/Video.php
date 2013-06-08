<?php

namespace meedi\VideoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use meedi\VideoBundle\Validator\Constraints as VideoAssert;
use meedi\VideoBundle\Model\BaseVideo;
/**
 * Video
 *
 * @ORM\MappedSuperclass()
 * @ORM\HasLifecycleCallbacks()
 */
class Video extends BaseVideo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="videoId", type="string", length=255)
     */
    protected $videoId;

    /**
     * @var integer
     *
     * @ORM\Column(name="duration", type="integer")
     */
    protected $duration;

    /**
     * @var string
     *
     * @ORM\Column(name="providername", type="string", length=255)
     */
    protected $providername;

    /**
     * @var string
     *
     * @VideoAssert\VideoUrl()
     */
    protected $video_url;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Video
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set videoId
     *
     * @param string $videoId
     * @return Video
     */
    public function setVideoId($videoId)
    {
        $this->videoId = $videoId;
    
        return $this;
    }

    /**
     * Get videoId
     *
     * @return string 
     */
    public function getVideoId()
    {
        return $this->videoId;
    }

    /**
     * Set duration
     *
     * @param integer $duration
     * @return Video
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    
        return $this;
    }

    /**
     * Get duration
     *
     * @return integer 
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set providername
     *
     * @param string $providername
     * @return Video
     */
    public function setProvidername($providername)
    {
        $this->providername = $providername;
    
        return $this;
    }

    /**
     * Get providername
     *
     * @return string 
     */
    public function getProvidername()
    {
        return $this->providername;
    }

    public function setVideoUrl($url)
    {
        $this->video_url = $url;

        return $this;
    }

    public function getVideoUrl()
    {
        return $this->video_url;
    }

    /**
    * @ORM\PrePersist()
    */
    public function setProviderNameValue()
    {
        $this->setProvidername($this->provider->getProviderName());
    }
}
