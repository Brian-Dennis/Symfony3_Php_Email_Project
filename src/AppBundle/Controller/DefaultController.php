<?php

namespace AppBundle\Controller;

use AppBundle\Entity\PropertyOwner;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="dashboard")
     */
    public function indexAction(Request $request)
    {
        return $this->render('dashboard/index.html.twig');
    }

    /**
     * @Route("/property_owners", name="property_owners")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function propertyOwnersAction(Request $request)
    {
        $em = $this->get('doctrine')->getManager();
        $properties = $em->getRepository('AppBundle:PropertyOwner');
        /** @var PropertyOwner[] $allProperties */
        $allProperties = $properties->findAll();

        $emailSubject = "On-Top Realty Subject Here";

        $emailBody = "Hello,";
        $emailBody .= "\nWe wanted to see how you are doing.";
        $emailBody .= "\nBest,";
        $emailBody .= "\nOn-Top Realty";

        $bccArr = array();
        foreach ($allProperties as $property) {
            $emailAdd = $property->getEmail();
            $multipleEmails = explode(',', $emailAdd);
            foreach ($multipleEmails as $multipleEmailIndx => $multipleEmailData) {
                $cleanedEmailAddr = trim($multipleEmailData);
                if (!in_array(trim($cleanedEmailAddr), $bccArr) && !empty($cleanedEmailAddr)) {
                    $bccArr[] = $cleanedEmailAddr;
                }
            }
        }
        $bccEmails = implode(',', $bccArr);

        return $this->render(':dashboard:property_owners.html.twig', array(
            'properties' => $allProperties,
            'bccEmails' => $bccEmails,
            'emailSubject' => rawurlencode($emailSubject),
            'emailBody' => rawurlencode($emailBody)
        ));
    }

    /**
     * @Route("/edit_owners/{id}", name="edit_owners")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('AppBundle:PropertyOwner')->find($id);

        if (!$post) {
            throw $this->createNotFoundException(
                'No Property Owner found'
            );
        }

        $form = $this->createFormBuilder($post)
            ->add('name', TextType::class)
            ->add('phoneNumbers', TextType::class)
            ->add('email', TextType::class)
            ->add('address', TextType::class)
            ->add('properties', TextType::class)
            ->add('save', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('property_owners');
        }

        return $this->render(':dashboard:edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}


