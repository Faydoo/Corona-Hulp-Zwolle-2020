<?php

namespace App\Controller;

use App\Entity\Location;
use App\Entity\Profile;
use App\Form\CategoryEmbeddedType;
use App\Form\ProfileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/mijn-profiel")
 */
class ProfileController extends AbstractController
{
    /**
     * @Route("/", name="mijn-profiel-index", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function profile(Request $request): Response
    {
        /** @var Profile $profile */
        $profile = $this->getUser()->getProfile();
        $profileForm = $this->createForm(ProfileType::class, $profile);
        $profileForm->handleRequest($request);

        if ($profileForm->isSubmitted() && $profileForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();


            return $this->redirectToRoute('mijn-profiel-index');
        }

        return $this->render('profile/index.html.twig', [
            'profileForm' => $profileForm->createView()
        ]);
    }

    /**
     * @Route("/aanbieden", name="mijn-profiel-aanbieden", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function offer(Request $request): Response
    {
        $profile = $this->getUser()->getProfile();
        $offerForm = $this->createFormBuilder($profile)
            ->add('helpOfferedTitle', TextType::class,
                [
                    'label' => false,
                    'attr' => [
                        'class' =>  'form-control',
                        'placeholder' => 'Voer een korte beschrijving in'
                    ]
                ])
            ->add('helpOfferedText', TextareaType::class,
                [
                    'label' => false,
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => 'Voer een beschrijving in van de werkzaamheden en hulp die u kunt bieden',
                        'cols' => 30,
                        'rows' => 7
                    ]
                ])
            ->add('location', EntityType::class,
                [
                    'label' => false,
                    'class' => Location::class,
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ])
            ->add('category', CollectionType::class,
                [
                    'label' => false,
                    'entry_type' => CategoryEmbeddedType::class,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'allow_extra_fields' => true,
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ])
            ->add('visible', CheckboxType::class)
            ->add('save', SubmitType::class, [
                'label' => 'Opslaan',
                'attr' => [
                    'class' => 'btn btn-block btn-success mt-3'
                ]
            ])
            ->getForm();

        $offerForm->handleRequest($request);
        if ($offerForm->isSubmitted() && $offerForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Uw gegevens zijn aangepast.');
            return $this->redirectToRoute('mijn-profiel-aanbieden');
        }

        return $this->render('profile/aanbieden.html.twig', [
            'offerForm' => $offerForm->createView()
        ]);
    }

    /**
     * @Route("/vragen", name="mijn-profiel-vragen", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function want(Request $request): Response
    {
        /** @var Profile $profile */
        $profile = $this->getUser()->getProfile();
        $profileForm = $this->createForm(ProfileType::class, $profile);
        $profileForm->handleRequest($request);

        if ($profileForm->isSubmitted() && $profileForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();


            return $this->redirectToRoute('mijn-profiel-index');
        }

        return $this->render('profile/vragen.html.twig', [
            'profileForm' => $profileForm->createView()
        ]);
    }

    /**
     * @Route("/gebruiker", name="mijn-profiel-gebruiker", methods={"GET","POST"})
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return Response
     */
    public function user(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = $this->getUser();
        $userForm = $this->createFormBuilder($user)
            ->add('email', EmailType::class,
                [
                    'label' => false,
                    'attr' => [
                        'class' =>  'form-control'
                    ]
                ])
            ->add('plainPassword', RepeatedType::class,
                [
                    'type' => PasswordType::class,
                    'first_options'  => [ 'label' => false, 'attr' => [ 'class' =>  'form-control']],
                    'second_options' => [ 'label' => false, 'attr' => [ 'class' =>  'form-control']],
                    'invalid_message' => 'Beide wachtwoorden komen niet overeen',
                    'required' => false
                ])
            ->add('save', SubmitType::class, [
                'label' => 'Opslaan',
                'attr' => [
                    'class' => 'btn btn-block btn-success mt-3'
                ]
            ])
            ->getForm();

        $userForm->handleRequest($request);

        if ($userForm->isSubmitted() && $userForm->isValid()) {
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Uw gegevens zijn aangepast.');
            return $this->redirectToRoute('mijn-profiel-gebruiker');
        }

        return $this->render('profile/gebruiker.html.twig', [
            'userForm' => $userForm->createView()
        ]);
    }
}