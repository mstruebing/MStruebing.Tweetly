<?php
namespace MStruebing\Tweetly\Controller;

/*
 * This file is part of the MStruebing.Tweetly package.
 */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Mvc\ActionRequest;
use TYPO3\Flow\Security\Authentication\Controller\AbstractAuthenticationController;

class LoginController extends AbstractAuthenticationController
{

    /**
     * @return void
     */
    public function indexAction()
    {
    }

    /**
     * Will be triggered upon successful authentication
     *
     * @param ActionRequest $originalRequest The request that was intercepted by the security framework, NULL if there was none
     * @return string
     */
    protected function onAuthenticationSuccess(ActionRequest $originalRequest = NULL)
    {
        if ($originalRequest !== NULL)
        {
            $this->redirectToRequest($originalRequest);
        }
        $this->redirect('index', 'User');
    }

    /**
     * Logs all active tokens out and redirects the user to the login form
     *
     * @return void
     */
    public function logoutAction()
    {
        parent::logoutAction();
        $this->addFlashMessage('Logout successful');
        $this->redirect('index');
    }

}
