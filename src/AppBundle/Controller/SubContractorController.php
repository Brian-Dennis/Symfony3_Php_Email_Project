<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Vendor;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class SubContractorController extends Controller
{

    /**
     * @Route("/sub_contractors", name="sub_contractors")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function SubContractorAction(Request $request)
    {
        $em = $this->get('doctrine')->getManager();
        $vendor = $em->getRepository('AppBundle:Vendor');
        /** @var Vendor[] $allProperties */
        $allVendors = $vendor->findAll();

        $emailSubject = "On-Top Realty Subject Here";

        $emailBody = "Hello,";
        $emailBody .= "\nWe wanted to see how you are doing.";
        $emailBody .= "\nBest,";
        $emailBody .= "\nOn-Top Realty";

        $bccArr = array();
        foreach ($allVendors as $vendor) {
            $emailAdd = $vendor->getEmail();
            $multipleEmails = explode(',', $emailAdd);
            foreach ($multipleEmails as $multipleEmailIndx => $multipleEmailData) {
                $cleanedEmailAddr = trim($multipleEmailData);
                if (!in_array(trim($cleanedEmailAddr), $bccArr) && !empty($cleanedEmailAddr)) {
                    $bccArr[] = $cleanedEmailAddr;
                }
            }
        }
        $bccEmails = implode(',', $bccArr);

        return $this->render(':dashboard:sub_contractors.html.twig', array(
            'vendors' => $allVendors,
            'bccEmails' => $bccEmails,
            'emailSubject' => rawurlencode($emailSubject),
            'emailBody' => rawurlencode($emailBody)
        ));
    }

    /**
     * @Route("/edit_contacts/{id}", name="edit_contacts")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('AppBundle:Vendor')->find($id);

        if (!$post) {
            throw $this->createNotFoundException(
                'No Contractor found'
            );
        }

        $form = $this->createFormBuilder($post)
            ->add('jobType', TextType::class)
            ->add('vendor', TextType::class)
            ->add('contact', TextType::class)
            ->add('phonenumber', TextType::class)
            ->add('email', TextType::class)
            ->add('save', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('sub_contractors');
        }

        return $this->render(':dashboard:edit_vendor.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}

