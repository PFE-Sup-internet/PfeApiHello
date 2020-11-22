<?php

namespace App\Controller;

use App\Entity\Person;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\User\User;

class GetMeAction extends AbstractController
{
   
    public function __invoke()
    {
      $user=$this->getUser();
     return $user;
    }
}