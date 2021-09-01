<?php

namespace App\Controller;

use App\CacheKernel;
use App\Entity\Game;
use Doctrine\Persistence\ManagerRegistry;
use FOS\HttpCacheBundle\Configuration\Tag;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/game')]
class GameController extends AbstractController
{
    #[Route('/', methods: 'POST')]
    public function createGame(ManagerRegistry $registry): Response
    {
        $game = new Game();
        $game->setDate(new \DateTime());
        $game->setTitle("Test game");
        $game->setHomeScore(0);
        $game->setAwayScore(0);

        $manager = $registry->getManager();

        $manager->persist($game);
        $manager->flush();

        return $this->json($game);
    }

    #[Route('/{id}', methods: 'GET')]
    #[Cache(maxage: 30, public: true)]
    #[Tag('game', expression: "'game'~id")]
    public function gameAction(Game $game): Response
    {
        return $this->json($game);
    }

    #[Route('/{id}', methods: 'POST')]
    #[Cache(maxage: 30, public: true)]
    #[Tag('game', expression: "'game'~id")]
    public function gameUpdateAction(Game $game, ManagerRegistry $registry): Response
    {
        $game->setHomeScore($game->getHomeScore() + 1);
        $registry->getManager()->flush();
        return $this->json($game);
    }

    #[Route('/{id}/{team}/increment-score', requirements: ['team' => 'home|away'], methods: 'POST')]
    #[Tag('game', expression: "'game'~id")]
    public function incrementScore(CacheKernel $kernel, ManagerRegistry $registry, Request $request, Game $game, string $team): Response
    {
        if ($team == 'home') {
            $game->setHomeScore($game->getHomeScore() + 1);
        } else {
            $game->setAwayScore($game->getAwayScore() + 1);
        }

        $registry->getManager()->flush();

        $kernel->getStore()->purge($request->getSchemeAndHttpHost() . '/game/' . $game->getId());

        return $this->json($game);
    }
}
