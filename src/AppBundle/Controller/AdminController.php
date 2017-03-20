<?php

namespace AppBundle\Controller;

use JavierEguiluz\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AdminController extends BaseAdminController
{
  /**
   * @Route("/", name="easyadmin")
   * @Route("/", name="admin")
   */
  public function indexAction(Request $request)
  {
    return parent::indexAction($request);
  }

  protected function prePersistEntity($entity)
  {
    if ('QuizBundle\Entity\Quiz' == $this->entity['class']) {
      $user = $this->getUser();
      $entity->setUser($user);
    }
  }

  protected function createNewForm($entity, array $entityProperties)
  {
    $newForm = parent::createNewForm($entity, $entityProperties);

    if ('QuizBundle\Entity\Answer' == $this->entity['class']) {
      $newForm->remove('is_right');
      $newForm->add('is_right', CheckboxType::class, array(
        'required' => false,
      ));
    }

    return $newForm;
  }
}
