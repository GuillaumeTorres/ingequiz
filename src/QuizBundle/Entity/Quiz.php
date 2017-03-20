<?php

namespace QuizBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Quiz
 *
 * @ORM\Table(name="quiz")
 * @ORM\Entity(repositoryClass="QuizBundle\Repository\QuizRepository")
 */
class Quiz
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="quiz")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="QuizBundle\Entity\Question", mappedBy="quiz", cascade={"persist", "remove"})
     */
    private $question;

    /**
     * @ORM\OneToMany(targetEntity="QuizBundle\Entity\Score", mappedBy="quiz")
     */
    private $score;

    public function __toString()
    {
        return $this->name;
    }

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
     * Set name
     *
     * @param string $name
     *
     * @return Quiz
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Quiz
     */
    public function setUser(\AppBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->question = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add question
     *
     * @param \QuizBundle\Entity\Question $question
     *
     * @return Quiz
     */
    public function addQuestion(\QuizBundle\Entity\Question $question)
    {
        $this->question[] = $question;

        return $this;
    }

    /**
     * Remove question
     *
     * @param \QuizBundle\Entity\Question $question
     */
    public function removeQuestion(\QuizBundle\Entity\Question $question)
    {
        $this->question->removeElement($question);
    }

    /**
     * Get question
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set score
     *
     * @param \QuizBundle\Entity\Score $score
     *
     * @return Quiz
     */
    public function setScore(\QuizBundle\Entity\Score $score = null)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return \QuizBundle\Entity\Score
     */
    public function getScore()
    {
        return $this->score;
    }
}
