<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\HelpWanted;
use App\Entity\Profile;
use App\Entity\User;
use App\Form\SignUpType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PageController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('pages/home.html.twig', [
            'helpWanted' => $this->getDoctrine()->getRepository(HelpWanted::class)->findAll(),
            'profiles' => $this->getDoctrine()->getRepository(Profile::class)->findBy([ 'visible' => true ]),
            'category' => $this->getDoctrine()->getRepository(Category::class)->findAll()
        ]);
    }

    /**
     * @Route("/aanmelden", name="aanmelden", methods={"GET","POST"})
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return Response
     */
    public function signUp(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $profile = new Profile();
        $user = new User($profile);

        $signUpForm = $this->createForm(SignUpType::class, $user);
        $signUpForm->handleRequest($request);

        if ($signUpForm->isSubmitted() && $signUpForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $profile->setDisplayName($user->getDisplayName());

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Uw account is aangemaakt, ga er is eem mail gestuurd naar: '.$user->getEmail().'. Open deze om uw account te activeren.');

            return $this->redirectToRoute('inloggen');
        }

        return $this->render('pages/aanmelden.html.twig', [
                'signUpForm' => $signUpForm->createView()
        ]);
    }

    /**
     * @Route("/gevraagd", name="gevraagd")
     */
    public function helpWanted()
    {
        return $this->render('pages/gevraagd.html.twig');
    }

    /**
     * @Route("/aangeboden", name="aangeboden")
     */
    public function helpOffered()
    {
        return $this->render('pages/aangeboden.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        return $this->render('pages/contact.html.twig');
    }
}
