<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Cars;
use AppBundle\Entity\Member;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CarController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        //fetch data
        $members = $this->getDoctrine()->getRepository('AppBundle:Member')->findAll();
        $cars = $this->getDoctrine()->getRepository('AppBundle:Cars')->findAll();
        return $this->render('car/index.html.twig', array('cars'=>$cars, 'members'=>$members));
    }

    /**
    * @Route("/details/{id}", name="detailspage")
    */
    public function detailsAction($id){
        $cars = $this->getDoctrine()->getRepository('AppBundle:Cars')->find($id);
        return $this->render('car/details.html.twig', array('cars' => $cars));
    }

    /**
     * @Route("/delete/{id}", name="deletepage")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $cars = $em->getRepository('AppBundle:Cars')->find($id);
        $em->remove($cars);
        $em->flush();
        $this->addFlash('notice', 'cars Removed');

        //name of the "/" page
        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/edit/{id}", name="editpage")
     */
    public function editAction($id, Request $request)
    {

        $cars = $this->getDoctrine()->getRepository('AppBundle:Cars')->find($id);

        $cars->setCarName($cars->getCarName());
        $cars->setCarType($cars->getCarType());
        $cars->setCarDate($cars->getCarDate());

        //edit form
        $form = $this->createFormBuilder($cars)
        ->add('carName', TextType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
        ->add('carType', TextType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))      
        ->add('carDate', TextType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px'))) 
        ->add('save', SubmitType::class, array('label'=> 'Update This Car', 'attr' => array('class'=> 'btn-primary', 'style'=>'margin-bottom:15px')))
        ->getForm();
        $form->handleRequest($request);

        //validate form
        if($form->isSubmitted() && $form->isValid()){

        //fetching data
        $carName = $form['carName']->getData();
        $carType = $form['carType']->getData();
        $carDate = $form['carDate']->getData();

        //set new data
        $em = $this->getDoctrine()->getManager();
           $cars = $em->getRepository('AppBundle:Cars')->find($id);
           $cars->setCarName($carName);
           $cars->setCarType($carType);
           $cars->setcarDate($carDate);

           $em->flush();
           $this->addFlash('notice', 'Car has been updated');
           
           return $this->redirectToRoute('homepage');
        }
        
       return $this->render('car/edit.html.twig', array('cars' => $cars, 'form' => $form->createView()));

    }

    /**
     * @Route("/create", name="createpage")
     */
    public function createAction(Request $request)
    {
        $cars = new Cars;

        //insert form
        $form = $this->createFormBuilder($cars)
        ->add('carName', TextType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
        ->add('carType', TextType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))      
        ->add('carDate', TextType::class, array('attr' => array('class'=> 'form-control', 'style'=>'margin-bottom:15px'))) 
        ->add('save', SubmitType::class, array('label'=> 'Add New Car', 'attr' => array('class'=> 'btn-primary', 'style'=>'margin-bottom:15px')))
        ->getForm();
        $form->handleRequest($request);

        //form validation
        if($form->isSubmitted() && $form->isValid()){
            //fetching data
            $carName = $form['carName']->getData();
            $carType = $form['carType']->getData();
            $carDate = $form['carDate']->getData();

            $cars->setCarName($carName);
            $cars->setCarType($carType);
            $cars->setCarDate($carDate);
            $em = $this->getDoctrine()->getManager();
            $em->persist($cars);
            $em->flush();
            $this->addFlash('notice', 'New Car Added');

            //name of the "/" page
            return $this->redirectToRoute('homepage'); 
        }

        return $this->render('car/create.html.twig', array('form' => $form->createView()));

    }
}
