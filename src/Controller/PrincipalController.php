<?php
namespace App\Controller;
use App\Contoller\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Adherent;
use App\Entity\Categorie;
use App\Form\AdherentType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
class PrincipalController extends AbstractController
{
    /**
     * @Route("/principal", name="principal")
     */
    public function index()
    {
        
        return $this->render('principal/index.html.twig', [
            'controller_name' => 'PrincipalController',
        ]);
    }
    /**
     * @Route("/accueil", name="accueil")
     */
    public function accueil()
    {
        return $this->render('principal/accueil.html.twig', [
            'controller_name' => 'PrincipalController',
        ]);
    }
    /**
     * @Route("/categories", name="categories")
     */
    public function categories()
    {
        return $this->render('principal/categories.html.twig', [
            'controller_name' => 'PrincipalController',
        ]);
    }
    /**
     * @Route("/entrainement", name="entrainement")
     */
    public function entrainement()
    {
        return $this->render('principal/entrainement.html.twig', [
            'controller_name' => 'PrincipalController',
        ]);
    }
    /**
     * @Route("/competitions", name="competitions")
     */
    public function competitions()
    {
        return $this->render('principal/competitions.html.twig', [
            'controller_name' => 'PrincipalController',
        ]);
    }
    /**
     * @Route("/adherent", name="adherent")
     */
    public function adherent()
    {
        $repository=$this->getDoctrine()->getRepository(adherent::class);
        $lesAdherent=$repository->findAll();
        return $this->render('principal/index.html.twig', [
            'adherents' => $lesAdherent,
            ]);
    
    }
    /**
     * @Route("/adherents", name="adherents")
     */
    public function adherents()
    {
        $unAdherent=new Adherent();
        $unAdherent->setNom("gertrude");
        $unAdherent->setDatenaissance(new \DateTime("06/13/2020"));
        $unAdherent->setAdresse("12 rue de");
        $unAdherent->setVille("rbx");
        $em=$this->getDoctrine()->getManager();
        $em->persist($unAdherent);
        $em->flush();



        return $this->render('principal/ajout.html.twig', [
            'controller_name' => 'PrincipalController',
        ]);
    
    }
    /**
     * @Route("/unadherent/{id}", name="unadherent")
     */
    public function adherentid($id)
    {
        $repository=$this->getDoctrine()->getRepository(adherent::class);
        $lesAdherent=$repository->find($id);

        return $this->render('principal/id.html.twig', [
            'adherents' => $lesAdherent,
        ]);
    
    }
    /**
     * @Route("/adherent/modif/{id}", name="adherentmodif")
     */
    public function adherentmodif($id)
    {
        $repository=$this->getDoctrine()->getRepository(adherent::class);
        $lesAdherent=$repository->find($id);
        $lesAdherent->setVille("lille");


        $em=$this->getDoctrine()->getManager();
        $em->persist($lesAdherent);
        $em->flush();

        return $this->render('principal/modifid.html.twig', [
            'adherents' => $lesAdherent,
        ]);
    
    }
    /**
     * @Route("/adherent/supp/{id}", name="adherentsupp")
     */
    public function adherentsup($id)
    {
        $repository=$this->getDoctrine()->getRepository(adherent::class);
        $lesAdherent=$repository->find($id);
        $em=$this->getDoctrine()->getManager();

        $em->remove($lesAdherent);
        $em->flush();
        
        return $this->redirectToRoute('adherent', [
            'adherents' => $lesAdherent,
        ]);
    
    }
    /**
     * @Route("/adherent/inscription", name="adherentinscrit")
     */
    public function inscription(Request $request){
        $em=$this->getDoctrine()->getManager();
        $adherent=new Adherent();
        $form=$this->createForm(AdherentType::class,$adherent);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $adherent=$form->getData();
            $em->persist($adherent);
            $em->flush();
            return $this->redirectToRoute('adherent');
        }
        return $this->render('principal/inscript.html.twig', [
            'form' =>$form->createView(),
        ]);
    }
    /**
     * @Route("/adherent/modifAdherent/{id}", name="modifadherent")
     */
    public function modifAdherent($id,Request $request){
        $em=$this->getDoctrine()->getManager();
        $repository=$this->getDoctrine()->getRepository(adherent::class);
        $adherent=$repository->find($id);
        $form=$this->createForm(AdherentType::class,$adherent);
        $form->handleRequest($request);
        //Premiere ver de modif adherent sans la fonction form
        /*$form=$this->createFormBuilder($adherent)
                    ->add('nom',TextType::class,array('label'=>'Nom de l\'adherent:'))
                    ->add('datenaissance',DateType::class)
                    ->add('adresse',TextType::class)
                    ->add('ville',TextType::class)
                    ->add('save',SubmitType::class,array('label'=>'Enregistrer l\'adherent:'))
                    ->getForm();
                    $form->handleRequest($request);
                    */
        if($form->isSubmitted() && $form->isValid()){
            $adherent=$form->getData();
            $em->persist($adherent);
            $em->flush();
            return $this->redirectToRoute('adherent');
        }               
        return $this->render('principal/modifadherent.html.twig', [
            'form' =>$form->createView(),
        ]);
    }
}