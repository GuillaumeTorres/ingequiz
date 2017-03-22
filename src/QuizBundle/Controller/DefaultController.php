<?php

namespace QuizBundle\Controller;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
      if ($request->isMethod('GET')) {
        $form = $this->createFormBuilder()
          ->add('quiz' , EntityType::class, array(
            'class' => 'QuizBundle\Entity\Quiz',
            'label' => 'name',
            'attr' => array('class' => 'form-group'),
          ))
          ->add('start_tournament', SubmitType::class, array(
            'attr' => array('class' => 'btn btn-primary'),
            'label' => 'Choisir ce questionnaire',
          ))
          ->getForm();

        return $this->render('QuizBundle:Default:index.html.twig', array('form' => $form->createView()));
      }

      $data = $request->request->all();
      $quizId = $data['form']['quiz'];

      $quiz = $this->container->get('doctrine')->getManager()->getRepository('QuizBundle:Quiz')->findOneBy(array('id' => $quizId));

      return $this->render('QuizBundle:Default:quiz.html.twig', array('quiz' => $quiz));
    }
}
