<?php

namespace QuizBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use QuizBundle\Entity\Answer;
use QuizBundle\Entity\Question;
use QuizBundle\Entity\Quiz;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
      if ($request->isMethod('GET')) {
        $form = $this->createFormBuilder()
          ->add('quiz' , EntityType::class, array(
            'class' => 'QuizBundle\Entity\Quiz',
            'label' => 'Questionnaire',
            'attr' => array('class' => 'form-control selectpicker selectRep'),
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

      /** @var Quiz $quiz */
      $quiz = $this->container->get('doctrine')->getManager()->getRepository('QuizBundle:Quiz')->findOneBy(array('id' => $quizId));
      $form = $this->generateForm($quiz);

      return $this->render('QuizBundle:Default:quiz.html.twig', array(
        'form' => $form->createView(),
        'title' => $quiz->getName(),
        ));
    }

  /**
   * @param Request $request
   *
   * @return Response
   */
  public function resultAction(Request $request)
  {
    $questions = $request->request->all()['form'];
    unset($questions['save']);
    unset($questions['_token']);
    $isRight = true;
    $score = 0;
    foreach ($questions as $answers) {
      foreach ((array)$answers as $answer) {
        if (explode('_', $answer)[1] == '0') {
          $isRight = false;
        }
      }

      if ($isRight) {
        $score++;
      }
    }
    $convertScore = round(($score * 20) / count($questions), 2);

    return $this->render('QuizBundle:Default:result.html.twig', array(
      'score' => $score,
      'convertScore' => $convertScore,
    ));
  }

  /**
   * @param Quiz $quiz
   *
   * @return Form
   */
  private function generateForm($quiz)
  {
    $form = $this->createFormBuilder();
    $questions = $quiz->getQuestion();
    /** @var Question $question */
    foreach ($questions as $key => $question) {
      $answers = $this->formatAnswer($question->getAnswer());
      $form->add('question'.$key, ChoiceType::class, array(
        'choices' => $answers,
        'multiple' => true,
        'label' => $question->getQuestion(),
        'attr' => array('class' => 'selectpicker selectRep'),
      ));
    }
    $form
      ->add('save', SubmitType::class, array(
      'attr' => array('class' => 'btn btn-primary'),
      'label' => 'Obtenir son résultat',
    ));

    return $form->getForm();
  }

  /**
   * @param ArrayCollection $answers
   *
   * @return array
   */
  private function formatAnswer($answers)
  {
    $formatAnswers = [];
    /** @var Answer $answer */
    foreach ($answers as $key => $answer) {
      $formatAnswers[$answer->getAnswer()] = $key.'_'.(integer)$answer->getIsRight();
    }

    return $formatAnswers;
  }
}
