<?php

namespace App\Controller;

use App\Form\RegistrationType;
use App\Repository\UserRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }
    
    #[Route('/registration', 'app_registration')]
    public function registration(Request $request, UserRepository $repository,  UserPasswordHasherInterface $hasher)
    {
        $form = $this->createForm(RegistrationType::class);
        $userInfo = $form->handleRequest($request);
        
        if($form->isSubmitted()&& $form->isValid()){
            $userTest= $repository->findByEmail($userInfo->get('email')->getData());
            if(empty($userTest) == true ){         
                $user = $form->getData();
                $cryptedPassword = $hasher->hashPassword($user, $user->getPassword());
                $user->setPassword($cryptedPassword);
                $repository->save($user, true);
                return $this->redirectToRoute('app_login');
            }
            return $this->redirectToRoute('app_security_mailNotApprouved');
        }
        return $this->render('security/registration.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
