<?php
namespace MStruebing\Tweetly\Domain\Repository;

/*
 * This file is part of the MStruebing.Tweetly package.
 */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Persistence\Repository;

/**
 * @Flow\Scope("singleton")
 */
class UserRepository extends Repository
{

    /**
     * @Flow\Inject
     * @var TYPO3\Flow\Security\Context
     */
    protected $securityContext;

    // add customized methods here

    /**
     * returns the currently logged in user
     * @return \MStruebing\Tweetly\Domain\Model\User
     */
    public function findActiveUser() {
        return $this->findOneByUsername($this->securityContext->getAccount()->getAccountIdentifier());
    }

}
