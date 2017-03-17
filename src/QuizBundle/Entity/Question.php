<?php

namespace QuizBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 *
 * @ORM\Table(name="question")
 * @ORM\Entity(repositoryClass="QuizBundle\Repository\QuestionRepository")
 */
class Question
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="question", type="string", length=255)
     */
    private $question;

    /**
     * @ORM\ManyToOne(targetEntity="QuizBundle\Entity\Quiz", inversedBy="question")
     * @ORM\JoinColumn(name="quiz_id", referencedColumnName="id", nullable=false)
     */
    private $quiz;

    /**
     * @ORM\OneToMany(targetEntity="QuizBundle\Entity\Answer", mappedBy="question", cascade={"persist", "remove"})
     */
    private $answer;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set question
     *
     * @param string $question
     *
     * @return Question
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set quiz
     *
     * @param \QuizBundle\Entity\Quiz $quiz
     *
     * @return Question
     */
    public function setQuiz(\QuizBundle\Entity\Quiz $quiz)
    {
        $this->quiz = $quiz;

        return $this;
    }

    /**
     * Get quiz
     *
     * @return \QuizBundle\Entity\Quiz
     */
    public function getQuiz()
    {
        return $this->quiz;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->answer = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add answer
     *
     * @param \QuizBundle\Entity\Answer $answer
     *
     * @return Question
     */
    public function addAnswer(\QuizBundle\Entity\Answer $answer)
    {
        $this->answer[] = $answer;

        return $this;
    }

    /**
     * Remove answer
     *
     * @param \QuizBundle\Entity\Answer $answer
     */
    public function removeAnswer(\QuizBundle\Entity\Answer $answer)
    {
        $this->answer->removeElement($answer);
    }

    /**
     * Get answer
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnswer()
    {
        return $this->answer;
    }
}
