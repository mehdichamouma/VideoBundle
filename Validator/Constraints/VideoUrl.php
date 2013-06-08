<?php

namespace meedi\VideoBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */

class VideoUrl extends Constraint
{
    public $invalidId = 'Video not found on {{ provider }}';
    public $noProviderFound = 'No provider found for this url';

    public function validatedBy()
	{
	    return 'video_url.validator';
	}
}