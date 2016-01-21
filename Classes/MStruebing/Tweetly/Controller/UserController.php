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
     * @Flow\Inject
     * @var \TYPO3\Flow\Security\AccountFactory
     */
    protected $accountFactory;

    /**
     * @Flow\Inject
     * @var \TYPO3\Flow\Security\AccountRepository
     */
    protected $accountRepository;

    /**
     * @return void
     */
    public function indexAction()
    {
        $this->view->assign('users', $this->userRepository->findAll());
        $this->view->assign('activeUser', $this->userRepository->findActiveUser());
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
     * @param string $identifier
     * @param string $password
     * @return void
     */
    public function createAction($identifier, $password)
    {
        if ($this->accountRepository->countByAccountIdentifier($identifier) == 1 &&
            $this->userRepository->countByUsername($identifier) == 1) {
            $this->addFlashMessage('Nickname already taken, please choose another one!');
            $this->redirect('new');
        } else {
            $account = $this->accountFactory->createAccountWithPassword($identifier, $password);
            $this->accountRepository->add($account);
            $user = new User();
            $user->setUsername($identifier);
            $this->userRepository->add($user);
            $this->addFlashMessage('Account ' . $identifier . ' successful created! You can login now!');
            $this->redirect('index', 'Authentication');
        }
    }

    /**
     * @var MStruebing\Tweetly\Domain\Model\User $user
     * @return void
     */
    public function followAction(MStruebing\Tweetly\Domain\Model\User $user) {

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
