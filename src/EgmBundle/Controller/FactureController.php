<?php
namespace EgmBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
/*use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;*/
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

use EgmBundle\Entity\Facture;
use EgmBundle\Entity\Produit;
use EgmBundle\Entity\Setting;
use EgmBundle\Entity\Factureprod;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class FactureController extends Controller
{
    /**
     * @Route("/facture/add")
     */
    public function addAction(Request $request)
    {
    	$form = $this->createFormBuilder()
    	//->setAction('/facture/add')
        ->add('numfact', TextType::class, array('label' => 'Numéro de facture * :'))
        ->add('yearfact', TextType::class, array('label' => 'Année de la facture * :'))
        ->add('datefact', DateType::class, array('label' => 'Date de la facture * :'))
        ->add('societe', TextType::class, array('label' => 'Société * :'))
    	->add('ref', CollectionType::class, array(
            'entry_type'   => TextType::class,
            'entry_options'  => array(
                'attr'      => array('class' => 'form-control reference_field','Placeholder'=>'Référence')
            ),
            'allow_add' => true,
            'allow_delete' => true,
            'prototype' => true,
            'prototype_data' => '',
        ))
        ->add('name', CollectionType::class, array(
            // each entry in the array will be an "email" field
            'entry_type'   => TextType::class,
            'entry_options'  => array(
                'attr'      => array('class' => 'form-control name_field','Placeholder'=>'Nom produit')
            ),
            'allow_add' => true,
            'allow_delete' => true,
            'prototype' => true,
            'prototype_data' => '',
        )) 	
        ->add('istva', CheckboxType::class, array('label' => 'T.V.A :', 'required' => false))
        ->add('isrg', CheckboxType::class, array('label' => 'R.G :', 'required' => false))
        ->add('isras', CheckboxType::class, array('label' => 'R.A.S :', 'required' => false))
        ->add('istva2', CheckboxType::class, array('label' => 'T.V.A 2:', 'required' => false))
        ->add('istimbre', CheckboxType::class, array('label' => 'Timbre :', 'required' => false))
        ->add('tva', TextType::class)
        ->add('rg', TextType::class)
        ->add('ras', TextType::class)
        ->add('tva2', TextType::class)
        ->add('timbre', TextType::class)
        ->add('price', CollectionType::class, array(
            // each entry in the array will be an "email" field
            'entry_type'   => TextType::class,
            'entry_options'  => array(
                'attr'      => array('class' => 'form-control price_field','Placeholder'=>'Prix unitaire')
            ),
            'allow_add' => true,
            'allow_delete' => true,
            'prototype' => true,
            'prototype_data' => '',
        ))
        ->add('qte', CollectionType::class, array(
            // each entry in the array will be an "email" field
            'entry_type'   => TextType::class,
            'entry_options'  => array(
                'attr'      => array('class' => 'form-control qte_field','Placeholder'=>'Quantité')
            ),
            'allow_add' => true,
            'allow_delete' => true,
            'prototype' => true,
            'prototype_data' => '',
        ))
        ->add('totalprice', CollectionType::class, array(
            // each entry in the array will be an "email" field
            'entry_type'   => TextType::class,
            'entry_options'  => array(
                'attr'      => array('class' => 'form-control total_price','Placeholder'=>'Prix total')
            ),
            'allow_add' => true,
            'allow_delete' => true,
            'prototype' => true,
            'prototype_data' => '',
        ))
    	->getForm();

        $em = $this->getDoctrine()->getManager();
        $setting = $em->getRepository('EgmBundle:Setting')->find(1);

        $facture = $em->getRepository('EgmBundle:Facture')->createQueryBuilder('f')
                     ->select('max(f.numfact) as numfact')
                     ->where("f.yearfact = '".$setting->getYear()."'")
                     ->getQuery()
                     ->getResult();
        $myArray = array('');
        $form->get('ref')->setData($myArray);
        $form->get('name')->setData($myArray);
        $form->get('price')->setData($myArray);
        $form->get('qte')->setData($myArray);
        $form->get('totalprice')->setData($myArray);
        $form->get('yearfact')->setData($setting->getYear());
        $form->get('numfact')->setData($facture[0]['numfact'] ? $facture[0]['numfact'] + 1 : 1);
        $form->get('tva')->setData($setting->getTva());
        $form->get('rg')->setData($setting->getRg());
        $form->get('ras')->setData($setting->getRas());
        $form->get('tva2')->setData($setting->getTva2());
        $form->get('timbre')->setData($setting->getTimbre());
        $form->get('datefact')->setData(new \DateTime());
    	$form->handleRequest($request);
		$session = new Session();
        

    	if($form->isValid()){
           /* echo '<pre>';print_r($form->get('ref')->getData());echo '</pre>';
            echo '<pre>';print_r($form->get('name')->getData());echo '</pre>';
            echo '<pre>';print_r($form->get('price')->getData());echo '</pre>';
            echo '<pre>';print_r($form->get('totalprice')->getData());echo '</pre>';exit;*/
            $facture = new Facture();
    		
            $societe = $form->get('societe')->getData();
            $yearfact = $form->get('yearfact')->getData();
            $numfact = $form->get('numfact')->getData();
    		$datefact = $form->get('datefact')->getData();
            $istva = $form->get('istva')->getData();
            $isrg= $form->get('isrg')->getData();
            $isras = $form->get('isras')->getData();
            $istva2 = $form->get('istva2')->getData();
            $istimbre = $form->get('istimbre')->getData();
            $tva = $form->get('tva')->getData();
            $rg= $form->get('rg')->getData();
            $ras = $form->get('ras')->getData();
            $tva2 = $form->get('tva2')->getData();
            $timbre = $form->get('timbre')->getData();
            $facture->setSociete($societe);
            $facture->setYearfact($yearfact);
            $facture->setNumfact($numfact);
            $facture->setDatefact($datefact);

    		$facture->setIstva($istva);
            $facture->setIsrg($isrg);
            $facture->setIsras($isras);
            $facture->setIstva2($istva2);
            $facture->setIstimbre($istimbre);

            $facture->setTva($tva);
            $facture->setRg($rg);
            $facture->setRas($ras);
            $facture->setTva2($tva2);
            $facture->setTimbre($timbre);

    		
        	$em->persist($facture);
        	$em->flush();
            $refArray = $form->get('ref')->getData();
            $nameArray = $form->get('name')->getData();
            $priceArray = $form->get('price')->getData();
            $qteArray = $form->get('qte')->getData();
            $totalpriceArray = $form->get('totalprice')->getData();
            foreach ($refArray as $key => $value) {
                $factureprod = new Factureprod();
                $factureprod->setIdfacture($facture->getId());
                $factureprod->setRef($refArray[$key]);
                $factureprod->setName($nameArray[$key]);
                $factureprod->setPrice($priceArray[$key]);
                $factureprod->setTotalprice($totalpriceArray[$key]);
                $factureprod->setQte($qteArray[$key]);
                $em->persist($factureprod);
                $em->flush();
            }
			//$session->start();
			$session->getFlashBag()->add('success', 'Formulaire sauvegarder');
    		return $this->redirectToRoute('show_facture');
    	}else{
    		
    	}
        return $this->render('EgmBundle:Facture:index.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/facture/show", name="show_facture")
     */
    public function showAction()
    {
    	$factures = $this->getDoctrine()
				        ->getRepository('EgmBundle:Facture')
				        //->find($productId);
				        ->findAll();
				        ;

        return $this->render('EgmBundle:Facture:show.html.twig', array('factures'=> $factures));
    }

    /**
     * @Route("/facture/edit/{id}", name="edit_facture")
     */
    public function editAction($id, Request $request)
    {
    	$form = $this->createFormBuilder()
    	->add('numfact', TextType::class, array('label' => 'Numéro de facture * :'))
        ->add('yearfact', TextType::class, array('label' => 'Année de la facture * :'))
        ->add('datefact', DateType::class, array('label' => 'Date de la facture * :'))
    	->add('societe', TextType::class, array('label' => 'Société * :'))
        ->add('istva', CheckboxType::class, array('label' => 'T.V.A :', 'required' => false))
        ->add('isrg', CheckboxType::class, array('label' => 'R.G :', 'required' => false))
        ->add('isras', CheckboxType::class, array('label' => 'R.A.S :', 'required' => false))
        ->add('istva2', CheckboxType::class, array('label' => 'T.V.A 2:', 'required' => false))
        ->add('istimbre', CheckboxType::class, array('label' => 'Timbre :', 'required' => false))
        ->add('tva', TextType::class)
        ->add('rg', TextType::class)
        ->add('ras', TextType::class)
        ->add('tva2', TextType::class)
        ->add('timbre', TextType::class)
    	->add('ref', CollectionType::class, array(
            'entry_type'   => TextType::class,
            'entry_options'  => array(
                'attr'      => array('class' => 'form-control reference_field','Placeholder'=>'Référence')
            ),
            'allow_add' => true,
            'allow_delete' => true,
            'prototype' => true,
            'prototype_data' => '',
        ))
        ->add('name', CollectionType::class, array(
            // each entry in the array will be an "email" field
            'entry_type'   => TextType::class,
            'entry_options'  => array(
                'attr'      => array('class' => 'form-control name_field','Placeholder'=>'Nom produit')
            ),
            'allow_add' => true,
            'allow_delete' => true,
            'prototype' => true,
            'prototype_data' => '',
        ))  

        ->add('price', CollectionType::class, array(
            // each entry in the array will be an "email" field
            'entry_type'   => TextType::class,
            'entry_options'  => array(
                'attr'      => array('class' => 'form-control  price_field','Placeholder'=>'Prix unitaire')
            ),
            'allow_add' => true,
            'allow_delete' => true,
            'prototype' => true,
            'prototype_data' => '',
        ))
        ->add('qte', CollectionType::class, array(
            // each entry in the array will be an "email" field
            'entry_type'   => TextType::class,
            'entry_options'  => array(
                'attr'      => array('class' => 'form-control  qte_field','Placeholder'=>'Quantité')
            ),
            'allow_add' => true,
            'allow_delete' => true,
            'prototype' => true,
            'prototype_data' => '',
        ))
        ->add('totalprice', CollectionType::class, array(
            // each entry in the array will be an "email" field
            'entry_type'   => TextType::class,
            'entry_options'  => array(
                'attr'      => array('class' => 'form-control  total_price','Placeholder'=>'Prix total')
            ),
            'allow_add' => true,
            'allow_delete' => true,
            'prototype' => true,
            'prototype_data' => '',
        ))
        
    	->getForm();
        
        $em = $this->getDoctrine()->getEntityManager();
        $facture = $em->getRepository('EgmBundle:Facture')->find($id);
        $factureprod = $em->getRepository('EgmBundle:Factureprod')->findBy(array('idfacture' => $facture->getId() ));
        foreach ($factureprod as $produit) {
            $refArray[] = $produit->getRef();
            $nameArray[] = $produit->getName();
            $priceArray[] = $produit->getPrice();
            $qteArray[] = $produit->getQte();
            $totalpriceArray[] = $produit->getTotalprice();
        }
        $form->get('ref')->setData($refArray);
        $form->get('name')->setData($nameArray);
        $form->get('price')->setData($priceArray);
        $form->get('qte')->setData($qteArray);
        $form->get('totalprice')->setData($totalpriceArray);
        $form->get('societe')->setData($facture->getSociete());
        $form->get('yearfact')->setData($facture->getYearfact());
        $form->get('numfact')->setData($facture->getNumfact());
        $form->get('tva')->setData($facture->getTva());
        $form->get('rg')->setData($facture->getRg());
        $form->get('ras')->setData($facture->getRas());
        $form->get('tva2')->setData($facture->getTva2());
        $form->get('timbre')->setData($facture->getTimbre());
        //$form->get('datefact')->setData(new \DateTime($facture->getDatefact()->['date']));
        //\DateTime::createFromFormat('d-m-Y', $date)
        echo '<pre>';print_r($facture->getDatefact());echo '</pre>';exit;
    	$form->handleRequest($request);
		$session = new Session();

    	if($form->isValid()){
    		//$facture = new Facture();
    		$societe = $form->get('societe')->getData();
    		$facture->setSociete($societe);
    		$em = $this->getDoctrine()->getManager();
        	$em->persist($facture);
        	$em->flush();

            $refArray = $form->get('ref')->getData();
            $nameArray = $form->get('name')->getData();
            $priceArray = $form->get('price')->getData();
            $qteArray = $form->get('qte')->getData();
            $totalpriceArray = $form->get('totalprice')->getData();

            $query =  $em->createQuery('DELETE EgmBundle:Factureprod fp WHERE fp.idfacture = '. $facture->getId());
            $query->execute(); 
            $em->flush();

            foreach ($refArray as $key => $value) {
                $factureprod = new Factureprod();
                $factureprod->setIdfacture($facture->getId());
                $factureprod->setRef($refArray[$key]);
                $factureprod->setName($nameArray[$key]);
                $factureprod->setPrice($priceArray[$key]);
                $factureprod->setTotalprice($totalpriceArray[$key]);
                $factureprod->setQte($qteArray[$key]);
                $em->persist($factureprod);
                $em->flush();
            }

			$session->getFlashBag()->add('success', 'Formulaire modifier');
    		return $this->redirectToRoute('show_facture');
    	}
        return $this->render('EgmBundle:Facture:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

        /**
     * @Route("/facture/delete/{id}", name="delete_facture")
     */
    public function deleteAction($id)
    {
        
        $em = $this->getDoctrine()->getEntityManager();
        $facture = $em->getRepository('EgmBundle:Facture')->find($id);
        $session = new Session();
        $em = $this->getDoctrine()->getManager();
        
        $query =  $em->createQuery('DELETE EgmBundle:Factureprod fp WHERE fp.idfacture = '. $facture->getId());
        $query->execute(); 
        $em->flush();

        $em->remove($facture);
        $em->flush();
        //$session->start();
        $session->getFlashBag()->add('success', 'Facture Suprimer');
        return $this->redirectToRoute('show_facture');
    }

    /**
     * @Route("/ajax/reference/{query}", name="ajax_reference")
     */
    public function referenceAction(Request $request, $query)
    {
        $em = $this->getDoctrine()->getEntityManager();
        //$produits = $em->getRepository('EgmBundle:Produit')->findBy(array('ref' => $query ));
        $produits = $em->getRepository('EgmBundle:Produit')->createQueryBuilder('p')
                     ->where("p.ref like '%".$query."%'")
                     //->andWhere('o.Product LIKE :product')
                     //->setParameter('query', $query)
                     //->setParameter('product', 'My Products%')
                     ->getQuery()
                     ->getResult();

        if($request->isXmlHttpRequest()){
            return $this->render('EgmBundle:Ajax:reference.json.twig', array(
            'query' => $query,
            'produits' => $produits
        ));
        }
        
    }

    /**
     * @Route("/ajax/year/{query}", name="ajax_year")
     * @Method({"POST"})
     */
    public function yearAction(Request $request, $query)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $year = $em->getRepository('EgmBundle:Facture')->createQueryBuilder('f')
                     ->select('max(f.numfact) as numfact')
                     ->where("f.yearfact = '".$query."'")
                     ->getQuery()
                     ->getResult();

        if($request->isXmlHttpRequest() & $request->isMethod('POST')){
            return new Response($year[0]['numfact'] ? $year[0]['numfact'] + 1 : 1);
        }
        
    }

    /**
     * @Route("/ajax/societe/{query}", name="ajax_societe")
     * @Method({"POST"})
     */
    public function societeAction(Request $request, $query)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $societes = $em->getRepository('EgmBundle:Societe')->createQueryBuilder('s')
                     ->where("s.name like '%".$query."%'")
                     ->getQuery()
                     ->getResult();

        if($request->isXmlHttpRequest()){
            return $this->render('EgmBundle:Ajax:societe.json.twig', array(
            'query' => $query,
            'societes' => $societes
        ));
        }
        
    }
}