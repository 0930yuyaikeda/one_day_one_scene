<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
        $adminCount = count($adminRepository->findAll());

    //    return $this->render('index.html.twig',[]);
    //    return $this->render('inputName.html.twig',[]);
    //    return $this->render('chooseDecks.html.twig',[]);
    //    return $this->render('checkDeckAndName.html.twig',[]);
    //    return $this->render('question.html.twig',[]);
    //    return $this->render('result.html.twig',[]);
    //    return $this->render('scriptDescription.html.twig',[]);
    //    return $this->render('chooseScene.html.twig',[]);
    //    return $this->render('countdown.html.twig',[]);
       return $this->render('performance.html.twig',[]);
    }
}