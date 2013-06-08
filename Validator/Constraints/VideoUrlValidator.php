<?php

namespace meedi\VideoBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use meedi\VideoBundle\Component\VideoManager;

class VideoUrlValidator extends ConstraintValidator
{
	protected $manager;

	public function __construct(VideoManager $manager)
	{
		$this->manager = $manager;
	}

    public function validate($value, Constraint $constraint)
    {
    	$provider = $this->manager->getProviderFromUrl($value);

        if ($provider != null) 
        {
            if(!$provider->isValidVideoId($provider->getVideoIdFromUrl($value)))
            {
            	$this->context->addViolation($constraint->invalidId, array(
            						'{{provider}}' => $provider->getProviderName(),
            						), $value);
            }

            return;
        }

        $this->context->addViolation($constraint->noProviderFound, null, $value);
    }
}