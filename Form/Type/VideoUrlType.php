<?php
//
namespace meedi\VideoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use meedi\VideoBundle\Form\DataTransformer\VideoToUrlTransformer;
use meedi\VideoBundle\Component\VideoManager;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VideoUrlType extends AbstractType
{
  /**
   * @var ObjectManager
   */
  private $om;

  /**
   * @param ObjectManager $om
   */
  public function __construct(VideoManager $om)
  {
      $this->om = $om;
  }

  public function buildForm(FormBuilderInterface $builder, array $options)
  {
      $transformer = new VideoToUrlTransformer($this->om, $options['class']);
      $builder->appendNormTransformer($transformer);
  }

  public function setDefaultOptions(OptionsResolverInterface $resolver)
  {
      $resolver->setDefaults(array(
          'invalid_message' => 'Url doesn\'t reconizigned',
          'class' => '',
      ));
  }

  public function getParent()
  {
      return 'url';
  }

  public function getName()
  {
      return 'meedi_video_url';
  }
}



//use Symfony\Component\Form\AbstractType;
//use Symfony\Component\Form\FormBuilderInterface;
//use Symfony\Component\OptionsResolver\OptionsResolverInterface;
//use meedi\VideoBundle\Form\Subscriber\HydrateVideoFromUrl;
//
//class VideoUrlType extends AbstractType
//{
//  protected $hydrater;
//
//  public function __construct(HydrateVideoFromUrl $hydrater)
//  {
//      $this->hydrater = $hydrater;
//  }
//  public function buildForm(FormBuilderInterface $builder, array $options)
//  {
//      $builder->add('video_url');
//      $builder->addEventSubscriber($this->hydrater);
//  }
//
//  public function setDefaultOptions(OptionsResolverInterface $resolver)
//  {
//      $resolver->setDefaults(array(
//          'data_class' => 'meedi\VideoBundle\Entity\Video',
//      ));
//  }
//
//  public function getName()
//  {
//      return 'meedi_video_url';
//  }
//}