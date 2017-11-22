<?php

namespace SliderBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SliderBundle\Form\SlideType;
use SliderBundle\Entity\Slide;
use SliderBundle\Entity\Slider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class SlideController extends Controller
{

    /**
     * Ajouter
     */
    public function ajouterAdminAction(Request $request, Slider $slider)
    {
        $slide = new Slide;
        $form = $this->get('form.factory')->create(SlideType::class, $slide);

        /* Récéption du formulaire */
        if ($form->handleRequest($request)->isValid()){
            $slide->uploadImage();
            $slide->setSlider($slider);

            $em = $this->getDoctrine()->getManager();
            $em->persist($slide);
            $em->flush();

            $request->getSession()->getFlashBag()->add('succes', 'Slide enregistré avec succès');
            return $this->redirect($this->generateUrl('admin_sliderslide_manager',array('slider' => $slider->getId())));
        }

        /* BreadCrumb */
        $breadcrumb = array(
            'Accueil' => $this->generateUrl('admin_page_index'),
            'Gestion des sliders' => $this->generateUrl('admin_slider_manager'),
            'Gestion des slides' => $this->generateUrl('admin_sliderslide_manager', array('slider' => $slider->getId())),
            'Ajouter un slide' => ''
        );

        return $this->render('SliderBundle:Admin/Slide:ajouter.html.twig',
            array(
                'form' => $form->createView(),
                'slider' => $slider,
                'breadcrumb' => $breadcrumb
            )
        );
    }

    /**
     * Gestion
     */
    public function managerAdminAction(Request $request, Slider $slider)
    {
        /* La liste des slides */
        $slides = $this->getDoctrine()
                       ->getRepository('SliderBundle:Slide')
                       ->findBy(array('slider' => $slider),array('id' => 'DESC'));

        /* BreadCrumb */
        $breadcrumb = array(
            'Accueil' => $this->generateUrl('admin_page_index'),
            'Gestion des sliders' => $this->generateUrl('admin_slider_manager'),
            'Gestion des slides' => ''
        );

        return $this->render( 'SliderBundle:Admin/Slide:manager.html.twig', array(
                'slides' => $slides,
                'slider' => $slider,
                'breadcrumb' => $breadcrumb
            )
        );

    }

    /**
     * Publication
     */
    public function publierAdminAction(Request $request, Slider $slider, Slide $slide){

        if($request->isXmlHttpRequest()){
            $state = $slide->reverseState();
            $slide->setIsActive($state);

            $em = $this->getDoctrine()->getManager();
            $em->persist($slide);
            $em->flush();

            return new JsonResponse(array('state' => $state));
        }

    }

    /**
     * Supprimer
     */
    public function supprimerAdminAction(Request $request, Slider $slider, Slide $slide)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($slide);
        $em->flush();

        $request->getSession()->getFlashBag()->add('succes', 'Slide supprimé avec succès');
        return $this->redirect($this->generateUrl('admin_sliderslide_manager', array('slider' => $slider->getId())));
    }

    /**
     * Modifier
     */
    public function modifierAdminAction(Request $request, Slider $slider, Slide $slide)
    {
        $form = $this->get('form.factory')->create(SlideType::class, $slide);

        /* Récéption du formulaire */
        if ($form->handleRequest($request)->isValid()){
            $slide->uploadImage();

            $em = $this->getDoctrine()->getManager();
            $em->persist($slide);
            $em->flush();

            $request->getSession()->getFlashBag()->add('succes', 'Slide enregistré avec succès');
            return $this->redirect($this->generateUrl('admin_sliderslide_manager',array('slider' => $slider->getId())));
        }

        /* BreadCrumb */
        $breadcrumb = array(
            'Accueil' => $this->generateUrl('admin_page_index'),
            'Gestion des sliders' => $this->generateUrl('admin_slider_manager'),
            'Gestion des slides' => $this->generateUrl('admin_sliderslide_manager',array('slider' => $slider->getId())),
            'Modifier un slide' => ''
        );

        return $this->render('SliderBundle:Admin/Slide:modifier.html.twig',
            array(
                'breadcrumb' => $breadcrumb,
                'slider' => $slider,
                'slide' => $slide,
                'form' => $form->createView()
            )
        );

    }

    /**
     * Poid
     */
    public function poidAdminAction(Request $request, Slider $slider, Slide $slide, $poid){

        if($request->isXmlHttpRequest()){
            $slide->setPoid($poid);

            $em = $this->getDoctrine()->getManager();
            $em->persist($slide);
            $em->flush();

            return new JsonResponse(array('status' => 'succes'));
        }

    }

}
