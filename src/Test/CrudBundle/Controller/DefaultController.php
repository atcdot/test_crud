<?php

namespace Test\CrudBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="main_page")
     * @Template("TestCrudBundle:Default:index.html.twig")
     */
    public function indexAction()
    {
        return [];
    }
}
