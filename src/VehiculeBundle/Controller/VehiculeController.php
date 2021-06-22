<?php

namespace VehiculeBundle\Controller;

use AppBundle\Entity\User;
use ClubBundle\Entity\formation;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Tests\Fixtures\ToString;
use VehiculeBundle\Entity\MaintenaceVehicule;
use VehiculeBundle\Entity\Vehicule;
use VehiculeBundle\Entity\VehiculeUser;
use VehiculeBundle\Form\EnvoyercontratType;
use VehiculeBundle\Form\EnvoyermailType;
use VehiculeBundle\Form\RechercheType;
use VehiculeBundle\Form\updateType;
use VehiculeBundle\Form\VehiculeRechercheType;
use VehiculeBundle\Form\VehiculeType;
use Symfony\Component\HttpFoundation\Request;
use VehiculeBundle\Form\VehiculeUserType;
use VehiculeBundle\Form\MaintenaceVehiculeType;
use VehiculeBundle\Repository\VehiculeRepository;

class VehiculeController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Vehicule/frontend/vehicule/indexx.html.twig');
    }

    // Admin
    public function afficheAction(Request $request)

    {   $vehicule = new Vehicule();
        $form = $this->createForm(VehiculeRechercheType::class, $vehicule);
        $form = $form->handleRequest($request);
        if ($form->isSubmitted() ) {
            $vehicule = $this->getDoctrine()->getRepository(Vehicule::class)
                ->findBy(array('matricule' => $vehicule->getMatricule())

                );
            /**
             * @var  $paginator \Knp\Component\Pager\Paginator
             */
            $paginator = $this->get('knp_paginator');
            $result= $paginator->paginate(
                $vehicule,
                $request->query->getInt('page',1),
                $request->query->getInt('limit',5 )

            );
            }

        else{

        $Vehicule = $this->getDoctrine()->getRepository(Vehicule::class)->findAll();
        /**
         * @var  $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $result= $paginator->paginate(
            $Vehicule,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',5 )

        );
        }
        return $this->render('@Vehicule/backend/AffichageVehicule.html.twig', array('v' => $result,
            'f'=>$form->createView()
            ));
    }

    // affichage d'une vehicule par son matricule pour l'admin
    public function afficheVehiculeeAction($matricule)
    {
        $Vehicule = $this->getDoctrine()->getRepository(Vehicule::class)->find($matricule);
        return ($this->render("@Vehicule/backend/detailsVehicule.html.twig", array('v' => $Vehicule)));
    }

    public function ajoutVehiculeAction(Request $request)
    {
        $Vehicule = new Vehicule();
        $form = $this->createForm(VehiculeType::class, $Vehicule);
        $form = $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $Vehicule->UploadProfilePicture();
            $em->persist($Vehicule);
            $em->flush();
            $this->addFlash('info', 'Ajout avec succés !');
            return $this->redirectToRoute('vehicules_Admin_affiche');

        }
        return
            $this->render("@V
            .html.twig",
                array('f' => $form->createView()));
    }

    public function updateAction(Request $request, $matricule)
    {
        $em = $this->getDoctrine()->getManager();
        $Vehicule = $em->getRepository(Vehicule::class)->find($matricule);
        $form = $this->createForm(VehiculeType::class, $Vehicule);
        $form = $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $Vehicule->UploadProfilePicture();
            $em->flush();
           $this->addFlash('info', 'update avec succce !');
            return $this->redirectToRoute('vehicules_Admin_affiche');

        }
        return
            $this->render("@Vehicule/backend/updateVehicule.html.twig",
                array('f' => $form->createView()));
    }

    public function deleteAction($matricule)
    {
        $em = $this->getDoctrine()->getManager();
        $Vehicule = $em->getRepository(Vehicule::class)->find($matricule);
        $em->remove($Vehicule);
        $em->flush();
        $this->addFlash('info', 'Suppression avec succées !');
        return $this->redirectToRoute("vehicules_Admin_affiche");
    }


    //client
    // Affichage de vehicules dont l'etat est disponible
    public function readAction(Request $request)
    {
        $Vehicule = new  Vehicule();

        $form = $this->createFormBuilder( $Vehicule, array(
            'action' => $this->generateUrl('vehicules_Client_affiche').'?term=',
            'method' => 'GET',
        ) )
            ->add('matricule', null, ['label' => ' Barre de recherche'] )
            ->getForm();

        $q = $request->query->get('term'); // use "term" instead of "q" for jquery-ui
        $results = $this->getDoctrine()->getRepository(Vehicule::class)->findLike($q);


        $Vehicule = $this->getDoctrine()->getRepository(Vehicule::class)->findBy(array('etat' => 'disponible'));

        /**
         * @var  $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $result= $paginator->paginate(
            $Vehicule,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',3)

        );

        return $this->render('@Vehicule/frontend/read.html.twig', array(
            'v' => $result,  'ff' => $form->createView(), 'vehicule' => $results
        ));
    }
// durreee
public function durre($d1,$d2)
{
   // \DateInterval::format('D') : string;
    $time_diff = ($d1->diff($d2));

   return $time_diff->format('%D jours');

}
    public function  tarif ($t,$dr)
    {
     //  $d= (string) $dr;
       $s= substr($dr,0,2);
      $a=  (int) $s;
        return $t * $a;
    }
    // Reserver
    public function afficheCAction(Request $request, $matricule)
    {    $em = $this->getDoctrine()->getManager();
        $Vehicule = $em->getRepository(Vehicule::class)->find($matricule);
        //
       $form = $this->createForm(EnvoyercontratType::class);
       $form = $form->handleRequest($request);

        $VehiculeUser= new VehiculeUser();
        $contrat_form = $this->createForm(VehiculeUserType::class, $VehiculeUser);
        $contrat_form = $contrat_form->handleRequest($request);


        if ($contrat_form->isSubmitted() and $contrat_form->isValid() ) {
        //    $user=$this->getUser()->getId();

            $em = $this->getDoctrine()->getManager();
            $Vehicule->setEtat('indisponible');

            $userr=$this->getUser();

            $Vehicule->setUser($userr);
            $VehiculeUser->setIdUser($userr);
            $VehiculeUser->setMatricule($matricule);
            $date1 = $VehiculeUser->getDateDebut();
            $date2 = $VehiculeUser->getDateFin();
            $t = $Vehicule->getPrix();
            $dr= $this->durre($date1,$date2);
            $tr = $this->tarif($t,$dr);
            $em->persist($VehiculeUser);
            $this->addFlash('warning', 'Vous avez passer une demande de location veuillez svp consulter votre mail pour la confirmé');
            $em->flush();
            // mail
            $c='MESSAGE FROM';
            $n='POSSEDANT L"ADRESSE MAIL: ';
            $O='ABOUT';
            $userr=$this->getUser();
            // $user = new User ();
            $mail= $userr->getEmail();
            $path=$Vehicule->getwebPath();
            $file = basename($path);
            $mg = '';

            $contenu='DEMANDE DE LOCATION VEHICULE';

            $data = 's4s.png';

            $img_string = base64_decode($data);
         //   $img = imagecreatefromstring($img_string);

            $message = (new \Swift_Message($form->getData()['subject']))
                ->setSubject($contenu)
                ->setFrom('s4sb.tobeornottobe@gmail.com')
                ->setTo($mail)
                ->setBody(
                   // $form->getData()['message'],
                    $this->renderView('@Vehicule/frontend/contrat.html.twig', array('v' => $Vehicule,
                        'u' => $userr,'vu'=>$VehiculeUser, 'd1'=>$date1,'d2'=>$date2,'dr'=>$dr,'tr'=>$tr,'f'=>$file)),
                    'text/html'
                )
                ->attach(\Swift_Image::fromPath('imgvehiculess/'.basename($path) ));

            ;
           // $img = $message->embed(\Swift_Image::fromPath();

            $this->get('mailer')->send($message);

            return $this->redirectToRoute('vehicules_Client_affiche');

        }
        $Vehicule = $this->getDoctrine()->getRepository(Vehicule::class)->find($matricule);

        return ($this->render("@Vehicule/frontend/location.html.twig",
            array('v' => $Vehicule, 'cf' => $contrat_form->createView())));
    }

    // Mes vehicules
    public function mesVehiculesAction()
    {
        $user=$this->getUser()->getId();
        $Vehicule = $this->getDoctrine()->getRepository(Vehicule::class)->findBy
        (array('User'=>$user));
        return $this->render('@Vehicule/frontend/Mesvehicules.html.twig', array('v' => $Vehicule));
    }
    public function maVehiculeAction($matricule)
    {
        $user=$this->getUser()->getId();
        $Vehicule = $this->getDoctrine()->getRepository(Vehicule::class)->find($matricule);
        $Vehiculeuser = $this->getDoctrine()->getRepository(VehiculeUser::class);
       $d=$Vehiculeuser->getDateFinLocation($user);
        return $this->render('@Vehicule/frontend/Mavehicule.html.twig',
            array('v'=>$Vehicule) );
    }


}
