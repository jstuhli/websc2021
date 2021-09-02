<?php


namespace App\Listener;


use App\Entity\Game;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PostFlushEventArgs;
use Symfony\Component\HttpKernel\HttpCache\StoreInterface;


class EntityChangeListener
{
    private StoreInterface $store;
    private array $urls = [];

    public function __construct(StoreInterface $store)
    {
        $this->store = $store;
    }

    public function postRemove(LifecycleEventArgs $eventArgs): void
    {
        $this->handleChanges($eventArgs);
    }

    public function postPersist(LifecycleEventArgs $eventArgs): void
    {
        $this->handleChanges($eventArgs);
    }

    public function postUpdate(LifecycleEventArgs $eventArgs): void
    {
        $this->handleChanges($eventArgs);
    }

    public function postFlush(PostFlushEventArgs $args): void
    {
        // If the transaction is not complete don't do anything to avoid race condition with purging before commit.
        if ($args->getEntityManager()->getConnection()->getTransactionNestingLevel() > 0) {
            return;
        }

        foreach ($this->urls as $url) {
//            $this->store->purge($url);
        }

        $this->urls = [];
    }

    private function handleChanges(LifecycleEventArgs $eventArgs): void
    {
        $entity = $eventArgs->getEntity();

        if($entity instanceof Game) {
            $this->urls[] = 'http://127.0.0.1:8000/game/' . $entity->getId();
        }
    }
}