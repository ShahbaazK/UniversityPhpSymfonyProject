<?php

namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $blogEntries = $em->getRepository('BloggerBlogBundle:Book')
            ->findAll();
        return $this->render('BloggerBlogBundle:Page:index.html.twig',
            ['book' => $blogEntries]);
    }


    public function aboutAction()
    {
        return $this->render('BloggerBlogBundle:Page:about.html.twig');
    }


    public function homeAction()
    {
        return $this->render('BloggerBlogBundle:Page:about.html.twig');
    }


    public function contactAction()
    {
        return $this->render('BloggerBlogBundle:Page:about.html.twig');
    }


}
