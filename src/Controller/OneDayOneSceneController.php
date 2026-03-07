<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

// Entity
use App\Entity\Admins;

// Repository
use App\Repository\AdminsRepository;


class OneDayOneSceneController extends AbstractController
{
    public function index(
        AdminsRepository $adminRepository
    ): Response
    {
        dd('Hello world!');
    }
}