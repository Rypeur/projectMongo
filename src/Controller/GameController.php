<?php

namespace App\Controller;


use App\Document\Game;
use App\Form\GameType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ODM\MongoDB\DocumentManager as DocumentManager;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/user/game")
 */
class GameController extends AbstractController
{
    /**
     * @Route()
     *
     */
    public function index(Request $request, DocumentManager $dm)
    {
        $gameRepository = $dm->getRepository(Game::class);

        $games = $gameRepository->findBy([], ['name' => 'ASC']);
        $form = $this->createForm(IntegerType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            return $this->redirectToRoute('app_game_read', array('id' => $form->getData()));
        }
        return $this->render('game/game.html.twig', ['jeux' => $games, 'form' => $form->createView()]);
    }

    /**
     * @Route ("/create")
     */
    public function create(Request $request,DocumentManager $dm)
    {
        $game = new Game();

        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $game->setUser($this->getUser());
            $dm->persist($game);
            $dm->flush();
            $this->addFlash('success', 'Le jeu a bien été ajouté !');


            return $this->redirectToRoute('app_game_index');
        }

        return $this->render('game/createGame.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}",requirements={"id":"\d+"})
     *
     */
    public function read(int $id,DocumentManager $dm)
    {
        $game = $dm->find(Game::class, $id);
        return $this->render('game/readGame.html.twig', ['jeu' => $game]);


    }

    /**
     * @Route("/{id}/update",requirements={"id":"\d+"},methods={"GET","POST"})
     */
    public function update(Request $request, Game $game,DocumentManager $dm)
    {
        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $dm->flush();
            $this->addFlash('success', 'Le jeu a bien été modifié !');
            return $this->redirectToRoute('app_game_index');
        }

        return $this->render('game/updateGame.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete",requirements={"id":"\d+"},methods={"GET"})
     */
    public function delete(Request $request, Game $game,DocumentManager $dm)
    {
        $token = $request->query->get('token');
        if ($this->isCsrfTokenValid('JEU_DELETE', $token)) {
            throw $this->createAccessDeniedException();
        }
        $dm->remove($game);
        $dm->flush();
        $this->addFlash('success', 'Le jeu a bien été supprimé !');
        return $this->redirectToRoute('app_game_index');

    }


}