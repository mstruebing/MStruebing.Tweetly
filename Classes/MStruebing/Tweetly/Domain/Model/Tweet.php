<?php
namespace MStruebing\Tweetly\Domain\Model;

/*
 * This file is part of the MStruebing.Tweetly package.
 */

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\Entity
 */
class Tweet
{

    /**
     * @ORM\ManyToOne
     * @var \MStruebing\Tweetly\Domain\Model\User
     */
    protected $author;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var \DateTime
     */
    protected $date;

    public function __construct() {
        $this->date = new \DateTime();
    }


    /**
     * @return \MStruebing\Tweetly\Domain\Model\User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param \MStruebing\Tweetly\Domain\Model\User $author
     * @return void
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return void
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

}
