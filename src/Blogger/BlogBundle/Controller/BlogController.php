<?php

namespace Blogger\BlogBundle\Controller;

use Blogger\BlogBundle\Form\EntryType;
use Blogger\BlogBundle\Entity\Entry;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class BlogController extends Controller
{
    public function viewAction($id)
    {
        // Get the doctrine Entity manager
        $em = $this->getDoctrine()->getManager();

        // Use the entity manager to retrieve the Entry entity for the id
        // that has been passed
        $blogEntry = $em->getRepository('BloggerBlogBundle:Entry')->find($id);

        return $this->render('BloggerBlogBundle:Blog:view.html.twig',
            ['entry' => $blogEntry]);
            // ...
    }

    public function createAction(Request $request)
    {
        $blogEntry = new Entry();

        $form = $this->createForm(EntryType::class, $blogEntry,[
            'action' => $request->getUri()
        ]);

        $form->handleRequest($request);

        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $blogEntry->setAuthor($this->getUser());

            $blogEntry->setTimestamp(new \DateTime());

            $em->persist($blogEntry);

            $em->flush();

            return $this->redirect($this->generateUrl('book_view',
                ['id' => $blogEntry->getId()]));
        }

        return $this->render('BloggerBlogBundle:Blog:create.html.twig',
            ['form' => $form->createView()]);
            // ...
    }

    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $blogEntry = $em->getRepository('BloggerBlogBundle:Entry')->find($id);
        $form = $this->createForm(EntryType::class, $blogEntry, [
            'action' => $request->getUri()
        ]);

        $form->handleRequest($request);

        if($form->isValid()){
            $em->flush();

            return $this->redirect($this->generateUrl('book_view',
                ['id' => $blogEntry->getId()]));
        }

        return $this->render('BloggerBlogBundle:Blog:edit.html.twig',
            ['form' => $form->createView(),
                'entry' => $blogEntry]);

    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $blogEntry = $em->getRepository('BloggerBlogBundle:Entry')->find($id);

        $em->remove($blogEntry);
        $em->flush();

        return $this->redirect($this->generateUrl('index'));
    }



    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        //$blogPosts = $em->getRepository('BloggerBlogBundle:Entry')->findAll();
        $queryBuilder = $em->getRepository('BloggerBlogBundle:Entry')->createQueryBuilder('bp');

        if($request->query->getAlnum('filter')) {
            $queryBuilder
                ->where('bp.title LIKE :title')
                ->setParameter('title', '%' . $request->query->getAlnum('filter') . '%');
        }

        $query = $queryBuilder->getQuery();

        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 4)
        );

        return $this->render('BloggerBlogBundle:Blog:list.html.twig', [
            'book_posts' => $result,
        ]);

        //return $this->render('BloggerBlogBundle:Blog:list.html.twig');
    }




}