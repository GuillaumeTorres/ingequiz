<?php

namespace QuizBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Answer
 *
 * @ORM\Table(name="answer")
 * @ORM\Entity(repositoryClass="QuizBundle\Repository\AnswerRepository")
 */
class Answer
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
     * @ORM\Column(name="answer", type="string", length=255)
     */
    private $answer;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_right", type="boolean")
     */
    private $isRight;

    /**
     * @ORM\ManyToOne(targetEntity="QuizBundle\Entity\Question", inversedBy="answer")
     * @ORM\JoinColumn(name="question_id", referencedColumnName="id", nullable=false)
     */
    private $question;


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
     * Set answer
     *
     * @param string $answer
     *
     * @return Answer
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get answer
     *
     * @return string
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set isRight
     *
     * @param boolean $isRight
     *
     * @return Answer
     */
    public function setIsRight($isRight)
    {
        $this->isRight = $isRight;

        return $this;
    }

    /**
     * Get isRight
     *
     * @return bool
     */
    public function getIsRight()
    {
        return $this->isRight;
    }

    /**
     * Set question
     *
     * @param \QuizBundle\Entity\Question $question
     *
     * @return Answer
     */
    public function setQuestion(\QuizBundle\Entity\Question $question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return \QuizBundle\Entity\Question
     */
    public function getQuestion()
    {
        return $this->question;
    }
}
