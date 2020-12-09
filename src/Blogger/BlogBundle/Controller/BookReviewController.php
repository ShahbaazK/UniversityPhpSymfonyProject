<?php

namespace Blogger\BlogBundle\Controller;

use Blogger\BlogBundle\Entity\BookReview;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Blogger\BlogBundle\Form\BookReviewType;
use Symfony\Component\HttpFoundation\Request;

class BookReviewController extends Controller
{
    public function viewAction($id)
    {
        // Get the doctrine Entity manager
        $em = $this->getDoctrine()->getManager();
        // Use the entity manager to retrieve the Entry entity for the id
        // that has been passed
        $blogBookReview = $em->getRepository('BloggerBlogBundle:BookReview')->find($id);
        // Pass the entry entity to the view for displaying
        return $this->render('BloggerBlogBundle:Blog:view.html.twig', ['bookreview' => $blogBookReview]);
    }

    public function createAction(Request $request)
    {
        // Create an new (empty) Entry entity
        $blogBookReview = new BookReview();
        // Create a form from the BookReviewType class to be validated
        // against the BookReview entity and set the form action attribute
        // to the current URI
        $form = $this->createForm(BookReviewType::class, $blogBookReview, [
            'action' => $request->getUri()
        ]);
        // If the request is post it will populate the form
        $form->handleRequest($request);
        // validates the form
        if ($form->isValid()) {

            // Retrieve the doctrine entity manager
            $em = $this->getDoctrine()->getManager();
            // manually set the author to the current user
            $blogBookReview->setAuthor($this->getUser());
            // manually set the timestamp to a new DateTime object
            $blogBookReview->setTimestamp(new \DateTime());
            // tell the entity manager we want to persist this entity
            $em->persist($blogBookReview);
            // commit all changes
            $em->flush();

            return $this->redirect($this->generateUrl('blogger_bookreview_view',
                ['id' => $blogBookReview->getId()]));
        }
            // Render the view from the twig file and pass the form to the view
            return $this->render('BloggerBlogBundle:BookReview:create.html.twig',
            ['form' => $form->createView()]);
    }

    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $blogBookReview = $em->getRepository('BloggerBlogBundle:BookReview')->find($id);
        $form = $this->createForm(BookReviewType::class, $blogBookReview, [
            'action' => $request->getUri()
        ]);
        $form->handleRequest($request);
        if($form->isValid()) {
            $em->flush();
            return $this->redirect($this->generateUrl('blogger_bookreview_view',
                ['id' => $blogBookReview->getId()]));
        }
        return $this->render('BloggerBlogBundle:Blog:edit.html.twig',
            ['form' => $form->createView(),
                'bookreview' => $blogBookReview]);
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $blogBookReview = $em->getRepository('BloggerBlogBundle:BookReview')->find($id);
        $em->remove($blogBookReview);
        $em->flush();


        return $this->redirect(
        $this->generateUrl('blogger_bookreview'));
    }

}
