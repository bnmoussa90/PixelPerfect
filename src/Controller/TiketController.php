<?php

namespace App\Controller;

use App\Entity\Statu;
use App\Entity\Tiket;
use App\Entity\TiketDetail;
use App\Form\TiketDetailForm;
use App\Form\TiketForm;
use App\Repository\StatuRepository;
use App\Repository\TiketDetailRepository;
use App\Repository\TiketRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;

use Symfony\Component\Mime\Email;

class TiketController extends AbstractController
{
    /**
     * @Route("/", name="tiket_index")
     */
    public function index(TiketRepository $tiketRepository): Response
    {


        $tikets = $tiketRepository->findAll(['active'=>1]);


        return $this->render('tiket/index.html.twig', [
            'controller_name' => 'TiketController',
            'tikets' => $tikets,
        ]);
    }

    /**
     * @Route("/tiket/add", name="add_tiket")
     */
    public function add(Request $request, MailerInterface $mailer): Response
    {
        $tiket = new Tiket();


        $form = $this->createForm(TiketForm::class, $tiket);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $tiket->setTitle($tiket->getTitle());
            $tiket->setDescription($tiket->getDescription());
            $tiket->setUser($this->getUser());
            $tiket->setActive(1);
            $em = $this->getDoctrine()->getManager();
            $em->persist($tiket);
            $em->flush();

            $email = (new Email())
                ->from('thexxjoker@gmail.com')
                ->to('benmoussa.it@gmail.com')
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                //->priority(Email::PRIORITY_HIGH)
                ->subject('ADD')
                ->text('Sending emails is fun again!')
                ->html('<p>See Twig integration for better HTML integration!</p>');

            $mailer->send($email);


            return $this->redirectToRoute('detail_tiket', array('id' => $tiket->getId()));
        }

        return $this->render('tiket/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/tiket/edit/{id}", name="edit_tiket")
     */
    public function edit(Tiket $tiket, Request $request, MailerInterface $mailer): Response
    {


        $form = $this->createForm(TiketForm::class, $tiket);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $tiket->setTitle($data->getTitle());
            $tiket->setDescription($tiket->getDescription());


            $em = $this->getDoctrine()->getManager();
            $em->persist($tiket);
            $em->flush();


            $email = (new Email())
                ->from('thexxjoker@gmail.com')
                ->to($tiket->getUser()->getEmail())
                ->subject(' your tiket statu is change')
                ->text('your tiket  is edit ')
                ->html('<p> your tiket statu is change ' . $tiket->getTitle() . '</p>');

            $mailer->send($email);

            return $this->redirectToRoute('detail_tiket', array('id' => $tiket->getId()));
        }

        return $this->render('tiket/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/tiket/detail/{id}", name="detail_tiket")
     */
    public function detail(StatuRepository $statuRepository, Tiket $tiket, Request $request, MailerInterface $mailer)
    {
        $statu = $statuRepository->findAll();
        $edtail = new TiketDetail();
        $form = $this->createForm(TiketDetailForm::class, $edtail);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $edtail->setReponse($data->getReponse());
            $edtail->setTiket($tiket);
            $edtail->setUser($this->getUser());

            $em = $this->getDoctrine()->getManager();
            $em->persist($edtail);
            $em->flush();

            $email = (new Email())
                ->from('thexxjoker@gmail.com')
                ->to($tiket->getUser()->getEmail())
                ->subject('ADD')
                ->text('your tiket statu is change ')
                ->html('<p> you have reponse from you status  </p>');

            $mailer->send($email);

            return $this->redirectToRoute('detail_tiket', array('id' => $tiket->getId()));
        }

        return $this->render('tiket/detail.html.twig', [
            'tiket' => $tiket,
            'status' => $statu,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/tiket/delete/{id}", name="delete_tiket")
     */
    public function delete(Tiket $tiket)
    {


        $em = $this->getDoctrine()->getManager();
        $em->remove($tiket);
        $em->flush();
        return $this->redirectToRoute('tiket_index', array('id' => $tiket->getId()));
    }

    /**
     * @Route("/tiket/statu/{id}/{idp}", name="statu_tiket")
     */
    public function statu(Tiket $tiket, int $idp, StatuRepository $statuRepository, MailerInterface $mailer): Response
    {

        /**
         * change status
         */
        $statu = $statuRepository->find($idp);

        $tiket->setSatatu($statu);

        $em = $this->getDoctrine()->getManager();
        $em->persist($tiket);
        $em->flush();

        /**
         * send email
         */
        $email = (new Email())
            ->from('thexxjoker@gmail.com')
            ->to($tiket->getUser()->getEmail())
            ->subject('ADD')
            ->text('your tiket statu is change ')
            ->html('<p> your tiket statu is change ' . $statu->getName() . '</p>');

        $mailer->send($email);

        return $this->redirectToRoute('detail_tiket', array('id' => $tiket->getId()));
    }


}
