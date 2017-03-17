<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="QuizBundle\Entity\Quiz", mappedBy="user")
     */
    private $quiz;

    /**
     * @ORM\OneToOne(targetEntity="QuizBundle\Entity\Score", mappedBy="user")
     */
    private $score;

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
     * Constructor
     */
    public function __construct()
    {
        $this->quiz = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add quiz
     *
     * @param \QuizBundle\Entity\Quiz $quiz
     *
     * @return User
     */
    public function addQuiz(\QuizBundle\Entity\Quiz $quiz)
    {
        $this->quiz[] = $quiz;

        return $this;
    }

    /**
     * Remove quiz
     *
     * @param \QuizBundle\Entity\Quiz $quiz
     */
    public function removeQuiz(\QuizBundle\Entity\Quiz $quiz)
    {
        $this->quiz->removeElement($quiz);
    }

    /**
     * Get quiz
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getQuiz()
    {
        return $this->quiz;
    }

    /**
     * Set score
     *
     * @param \QuizBundle\Entity\Score $score
     *
     * @return User
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
