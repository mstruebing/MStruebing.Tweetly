<?php
namespace MStruebing\Tweetly\Controller;

/*
 * This file is part of the MStruebing.Tweetly package.
 */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Mvc\Controller\ActionController;
use MStruebing\Tweetly\Domain\Model\User;

class UserController extends ActionController
{

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
        $this->view->assign('users', $this->userRepository->findAll());
    }

    /**
     * @param \MStruebing\Tweetly\Domain\Model\User $user
     * @return void
     */
    public function showAction(User $user)
    {
        $this->view->assign('user', $user);
    }

    /**
     * @return void
     */
    public function newAction()
    {
    }

    /**
     * @param \MStruebing\Tweetly\Domain\Model\User $newUser
     * @return void
     */
    public function createAction(User $newUser)
    {
        $this->userRepository->add($newUser);
        $this->addFlashMessage('Created a new user.');
        $this->redirect('index');
    }

    /**
     * @param \MStruebing\Tweetly\Domain\Model\User $user
     * @return void
     */
    public function editAction(User $user)
    {
        $this->view->assign('user', $user);
    }

    /**
     * @param \MStruebing\Tweetly\Domain\Model\User $user
     * @return void
     */
    public function updateAction(User $user)
    {
        $this->userRepository->update($user);
        $this->addFlashMessage('Updated the user.');
        $this->redirect('index');
    }

    /**
     * @param \MStruebing\Tweetly\Domain\Model\User $user
     * @return void
     */
    public function deleteAction(User $user)
    {
        $this->userRepository->remove($user);
        $this->addFlashMessage('Deleted a user.');
        $this->redirect('index');
    }

}
