<?php

namespace Blog\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AuthorController extends Controller
{
    /**
     * Show posts by author
     * @param string slug
     * @Route("/author/{slug}")
     * @Template()
     * @return array
     */
    public function showAction($slug)
    {
        $author = $this->getDoctrine()
            ->getRepository('ModelBundle:Author')
            ->findOneBy(array('slug' => $slug));

        if($author === null)
            throw $this->createNotFoundException('Author was not found');

        $posts = $this->getDoctrine()->getRepository('ModelBundle:Post')
                    ->findBy( array(
                              'author' => $author
                          )
                    );

        return array(
                'author' => $author,
                'posts' => $posts
             );
    }

}
