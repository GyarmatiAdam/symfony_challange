<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Member;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MemberController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        //fetch data
        $members = $this->getDoctrine()->getRepository('AppBundle:Member')->findAll();
        return $this->render('car/index.html.twig', array('members'=>$members));
    }
}