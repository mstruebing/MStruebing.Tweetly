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
class User
{

    /**
     * @var string
     */
    protected $username;

    /**
     * @ORM\OneToMany(mappedBy="user")
     * @ORM\OrderBy({"date" = "DESC"})
     * @var \MStruebing\Tweetly\Domain\Model\Tweet
     */
    protected $tweets;

    /**
     * @ORM\OneToMany(mappedBy="user")
     * @ORM\OrderBy({"username" = "DESC"})
     * @var \MStruebing\Tweetly\Domain\Model\User
     */
    protected $following;


    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return void
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return \MStruebing\Tweetly\Domain\Model\Tweet
     */
    public function getTweets()
    {
        return $this->tweets;
    }

    /**
     * @param \MStruebing\Tweetly\Domain\Model\Tweet $tweets
     * @return void
     */
    public function setTweets($tweets)
    {
        $this->tweets = $tweets;
    }

    /**
     * @return \MStruebing\Tweetly\Domain\Model\User
     */
    public function getFollowing()
    {
        return $this->following;
    }

    /**
     * @param \MStruebing\Tweetly\Domain\Model\User $following
     * @return void
     */
    public function setFollowing($following)
    {
        $this->following = $following;
    }

}
