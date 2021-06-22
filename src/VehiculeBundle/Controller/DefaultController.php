<?php

namespace VehiculeBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use VehiculeBundle\Form\EnvoyermailType;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $form=$this->createForm(EnvoyermailType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $c='MESSAGE FROM';
            $n='POSSEDANT L"ADRESSE MAIL: ';
            $O='ABOUT';
            $userr=$this->getUser();
           // $user = new User ();
            $mail= $userr->getEmail();
            $contenu=$c.' " '.$form->getData()['from'].' " '.$n.' " '.$mail.' " '.$O.' '.$form->getData()['subject'];
            $message = (new \Swift_Message($form->getData()['subject']))
                ->setSubject($contenu)
                ->setFrom('mariem.bechikhali@esprit.tn')
                ->setTo('s4sb.tobeornottobe@gmail.com')
                ->setBody(
                    $form->getData()['message'],
                    'text/plain'
                )
            ;
            //$form->getData()['from']

            $this->get('mailer')->send($message);
            $this->addFlash('info', 'Votre message est envoyé !');
        }

        return $this->render('@Vehicule/frontend/contacterNous.html.twig',
            array('f' => $form->createView()));
    }

}
