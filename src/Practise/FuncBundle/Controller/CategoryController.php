<?php

namespace Practise\FuncBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Practise\FuncBundle\Entity\Category;
use Practise\FuncBundle\Form\Type\CategoryTaskType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    /**
     * @Route("/category/read", name="category_read")
     */
    public function readAction()
    {
        $em = $this->getDoctrine()->getRepository('FuncBundle:Category');
        $category = $em -> findAll();
        return $this->render('FuncBundle:Category:read.html.twig', array('category' => $category));
    }
    
    /**
     * @Route("/category/create", name="category_create")
     */
    public function createAction(Request $request)
    {
        $category = new Category();   
        $form = $this->createForm(new CategoryTaskType(), $category);
        $form->handleRequest($request);    
        if ($form->isValid()) {
            $this->container->get('handle.func')->insertDatabase($category);
            return $this->redirect('/category/read');
        }   
        return $this->render('FuncBundle:Category:create.html.twig', array('form' => $form->createView(),));
    }

    /**
     * @Route("/category/update/{id}", name="category_update")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('FuncBundle:Category')->find($id);
    
        if (!$category) {
            throw $this->createNotFoundException(
                'No category found for id '.$id
            );
        }
        $form = $this->createForm(new CategoryTaskType(), $category);
        $form->handleRequest($request);    
        if ($form->isValid()) {
            $this->container->get('handle.func')->insertDatabase($category);
            return $this->redirect('/category/read');
        }
    
        return $this->render('FuncBundle:Category:create.html.twig', array('form' => $form->createView(),));
    }

     /**
     * @Route("/category/delete/{id}", name="category_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('FuncBundle:Category')->find($id);   
        if (!$category) {
            throw $this->createNotFoundException(
                'No category found for id '.$id
            );
        }   
        $this->container->get('handle.func')->deleteDatabase($category);
        return $this->redirect('/category/read');
    }
}