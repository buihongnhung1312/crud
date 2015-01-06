<?php

namespace Practise\FuncBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Practise\FuncBundle\Entity\Product;
use Practise\FuncBundle\Form\Type\ProductTaskType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * @Route("/product/read", name="product_read")
     */
    public function readAction()
    {
        $em = $this->getDoctrine()->getRepository('FuncBundle:Product');
        $product = $em -> findAll();
        return $this->render('FuncBundle:Product:read.html.twig', array('product' => $product));
    }
    
    /**
     * @Route("/product/create", name="product_create")
     */
    public function createAction(Request $request)
    {
        $product = new Product();   
        $form = $this->createForm(new ProductTaskType(), $product);
        $form->handleRequest($request);    
        if ($form->isValid()) {
            $this->container->get('handle.func')->insertDatabase($product);
            return $this->redirect('/product/read');
        }   
        return $this->render('FuncBundle:Product:create.html.twig', array('form' => $form->createView(),));
    }

    /**
     * @Route("/product/update/{id}", name="product_update")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('FuncBundle:Product')->find($id);
    
        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        $form = $this->createForm(new ProductTaskType(), $product);
        $form->handleRequest($request);    
        if ($form->isValid()) {
            $this->container->get('handle.func')->insertDatabase($product);
            return $this->redirect('/product/read');
        }
    
        return $this->render('FuncBundle:Product:create.html.twig', array('form' => $form->createView(),));
    }

     /**
     * @Route("/product/delete/{id}", name="product_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('FuncBundle:Product')->find($id);   
        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }   
        $this->container->get('handle.func')->deleteDatabase($product);
        return $this->redirect('/product/read');
    }
}