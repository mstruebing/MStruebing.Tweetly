<?php
namespace MStruebing\Tweetly\Controller;

/*
 * This file is part of the MStruebing.Tweetly package.
 */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Mvc\Controller\ActionController;
use MStruebing\Tweetly\Domain\Model\Tweet;
use MStruebing\Tweetly\Domain\Model\User;

class TweetController extends ActionController
{

    /**
     * @Flow\Inject
     * @var \MStruebing\Tweetly\Domain\Repository\TweetRepository
     */
    protected $tweetRepository;

    /**
     * @Flow\Inject
     * @var \MStruebing\Tweetly\Domain\Repository\UserRepository
     */
    protected $userRepository;

    /**
     * @return void
     */
    public function indexAction()
    {
        $this->view->assign('tweets', $this->tweetRepository->findAll());
    }

    /**
     * @param \MStruebing\Tweetly\Domain\Model\Tweet $tweet
     * @return void
     */
    public function showAction(Tweet $tweet)
    {
        $this->view->assign('tweet', $tweet);
    }

    /**
     * @param string $tweetContent
     * @return void
     */
    public function newAction($tweetContent)
    {
        $newTweet = new Tweet();
        $newTweet->setContent($tweetContent);
        $newTweet->setAuthor($this->userRepository->findActiveUser());
        $this->createAction($newTweet);
        $this->redirect('index', 'User');
    }

    /**
     * @param \MStruebing\Tweetly\Domain\Model\Tweet $newTweet
     * @return void
     */
    public function createAction(Tweet $newTweet)
    {
        $this->tweetRepository->add($newTweet);
        $this->addFlashMessage('Created a new tweet.');
    }

    /**
     * @param \MStruebing\Tweetly\Domain\Model\Tweet $tweet
     * @return void
     */
    public function editAction(Tweet $tweet)
    {
        $this->view->assign('tweet', $tweet);
    }

    /**
     * @param \MStruebing\Tweetly\Domain\Model\Tweet $tweet
     * @return void
     */
    public function updateAction(Tweet $tweet)
    {
        $this->tweetRepository->update($tweet);
        $this->addFlashMessage('Updated the tweet.');
        $this->redirect('index');
    }

    /**
     * @param \MStruebing\Tweetly\Domain\Model\Tweet $tweet
     * @return void
     */
    public function deleteAction(Tweet $tweet)
    {
        $this->tweetRepository->remove($tweet);
        $this->addFlashMessage('Deleted a tweet.');
        $this->redirect('index');
    }

}
