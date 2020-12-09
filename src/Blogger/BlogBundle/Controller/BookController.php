<?php

namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Blogger\BlogBundle\Entity\Book;
use Blogger\BlogBundle\Form\BookType;
use Symfony\Component\HttpFoundation\Request;

class BookController extends Controller
{
    public function viewAction($id)
    {
        // Get the doctrine Entity manager
        $em = $this->getDoctrine()->getManager();
        // Use the entity manager to retrieve the Entry entity for the id
        // that has been passed
        $blogBook = $em->getRepository('BloggerBlogBundle:Book')->find($id);


        // Pass the book entity to the view for displaying
        return $this->render('BloggerBlogBundle:Book:view.html.twig', ['book' => $blogBook]);
    }

    public function createAction(Request $request)
    {
        // Create an new (empty) Entry entity
        $blogBook = new Book();
        // Create a form from the BookType class to be validated
        // against the Book entity and set the form action attribute
        // to the current URI
        $form = $this->createForm(BookType::class, $blogBook, [
            'action' => $request->getUri()
        ]);
        // If the request is post it will populate the form
        $form->handleRequest($request);
        // validates the form
        if ($form->isValid()) {

//            $file=$blogBook->getImage();
//
//            $fileName = md5(uniqid()). '.' . $file->guessExtension();
//            $file->move(
//                $this->getParameter('uploads_directory'), $fileName
//            );

            // Retrieve the doctrine entity manager
            $em = $this->getDoctrine()->getManager();
            // manually set the author to the current user
            $blogBook->setAuthor($this->getUser());
            // manually set the timestamp to a new DateTime object

//            $blogBook->setImage($fileName);

            $em->persist($blogBook);
            // commit all changes
            $em->flush();

            return $this->redirect($this->generateUrl('blogger_book_view',
                ['id' => $blogBook->getId()]));
        }

        // Render the view from the twig file and pass the form to the view
        return $this->render('BloggerBlogBundle:Book:create.html.twig',
            ['form' => $form->createView()]);
    }

    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $blogBook = $em->getRepository('BloggerBlogBundle:Book')->find($id);
        $form = $this->createForm(BookType::class, $blogBook, [
            'action' => $request->getUri()
        ]);

        $form->handleRequest($request);

        if($form->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('blogger_book_view',
                ['id' => $blogBook->getId()]));
        }
        return $this->render('BloggerBlogBundle:Book:edit.html.twig',
            ['form' => $form->createView(),
                'book' => $blogBook]);
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $blogBook = $em->getRepository('BloggerBlogBundle:Book')->find($id);

        $em->remove($blogBook);
        $em->flush();


        return $this->redirect(
        $this->generateUrl('blogger_index'));
    }

}
