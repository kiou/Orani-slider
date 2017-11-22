<?php

namespace SliderBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SliderBundle\Form\SliderType;
use SliderBundle\Entity\Slider;
use Symfony\Component\HttpFoundation\Request;

class SliderController extends Controller
{
    /**
     * Ajouter
     */
    public function ajouterAdminAction(Request $request)
    {
        $slider = new Slider;
        $form = $this->get('form.factory')->create(SliderType::class, $slider);

        /* Récéption du formulaire */
        if ($form->handleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($slider);
            $em->flush();

            $request->getSession()->getFlashBag()->add('succes', 'Slider enregistré avec succès');
            return $this->redirect($this->generateUrl('admin_slider_manager'));
        }

        return $this->render('SliderBundle:Admin/Slider:ajouter.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }

    /**
     * Gestion
     */
    public function managerAdminAction(Request $request)
    {
        /* Services */
        $rechercheService = $this->get('recherche.service');
        $recherches = $rechercheService->setRecherche('slider_manager', array(
                'recherche'
            )
        );

        /* La liste des sliders */
        $sliders = $this->getDoctrine()
                        ->getRepository('SliderBundle:Slider')
                        ->getAllSliders($recherches['recherche']);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $sliders, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            50/*limit per page*/
        );

        return $this->render( 'SliderBundle:Admin/Slider:manager.html.twig', array(
                'pagination' => $pagination,
                'recherches' => $recherches
            )
        );

    }

    /**
     * Supprimer
     */
    public function supprimerAdminAction(Request $request, Slider $slider)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($slider);
        $em->flush();

        $request->getSession()->getFlashBag()->add('succes', 'Slider supprimé avec succès');
        return $this->redirect($this->generateUrl('admin_slider_manager'));
    }

    /**
     * Modifier
     */
    public function modifierAdminAction(Request $request, Slider $slider)
    {
        $form = $this->get('form.factory')->create(SliderType::class, $slider);

        /* Récéption du formulaire */
        if ($form->handleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($slider);
            $em->flush();

            $request->getSession()->getFlashBag()->add('succes', 'Slider enregistré avec succès');
            return $this->redirect($this->generateUrl('admin_slider_manager'));
        }

        /* BreadCrumb */
        $breadcrumb = array(
            'Accueil' => $this->generateUrl('admin_page_index'),
            'Gestion des sliders' => $this->generateUrl('admin_slider_manager'),
            'Modifier un slider' => ''
        );

        return $this->render('SliderBundle:Admin/Slider:modifier.html.twig',
            array(
                'breadcrumb' => $breadcrumb,
                'slider' => $slider,
                'form' => $form->createView()
            )
        );

    }

    /**
     * View
     */
    public function viewClientAction(Slider $slider)
    {
        /* La liste des slides */
        $slides = $this->getDoctrine()
                       ->getRepository('SliderBundle:Slide')
                       ->findBy(array('slider' => $slider, 'isActive' => true),array('poid' => 'DESC'));

        return $this->render('SliderBundle:Include:view.html.twig',
            array(
                'slides' => $slides
            )
        );
    }

}
