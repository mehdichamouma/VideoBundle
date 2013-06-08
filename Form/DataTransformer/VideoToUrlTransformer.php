<?php
// src/Acme/TaskBundle/Form/DataTransformer/IssueToNumberTransformer.php
namespace meedi\VideoBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use meedi\VideoBundle\Component\VideoManager;
use meedi\VideoBundle\Model\BaseVideo;

class VideoToUrlTransformer implements DataTransformerInterface
{
    /**
     * @var ObjectManager
     */
    private $vm;

    private $class;
    /**
     * @param ObjectManager $om
     */
    public function __construct(VideoManager $vm, $class)
    {
        $this->vm = $vm;
        $this->class = $class;
    }

    /**
     * Transforms an object (issue) to a string (number).
     *
     * @param  Issue|null $issue
     * @return string
     */
    public function transform($video)
    {
        if (null === $video) {
            return "";
        }

        return $this->vm->getUrlFromVideo($video);
    }

    /**
     * Transforms a string (number) to an object (issue).
     *
     * @param  string $number
     * @return Issue|null
     * @throws TransformationFailedException if object (issue) is not found.
     */
    public function reverseTransform($url)
    {
        if (!$url) {
            return null;
        }
        
        $video = new $this->class();
        $this->vm->updateVideoFromUrl($video , $url);


        return $video;
    }
}