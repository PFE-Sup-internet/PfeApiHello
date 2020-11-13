<?php

namespace App\Controller;

use App\Entity\Person;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\User;

final class GetMeAction extends AbstractController
{
    /**
    * @return User
    */
    public function __invoke()
    {
        /** @var Person $user */
        $user = $this->getUser();
        
        return $user->getTrips();
    }
}