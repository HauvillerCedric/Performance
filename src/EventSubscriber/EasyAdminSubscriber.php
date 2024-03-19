<?php

namespace App\EventSubscriber;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\{AfterEntityPersistedEvent, AfterEntityUpdatedEvent, AfterEntityDeletedEvent};

class EasyAdminSubscriber implements EventSubscriberInterface
{
    public function __construct(private RequestStack $requestStack)
    {
    }

    public static function getSubscribedEvents()
    {
        return [
            AfterEntityPersistedEvent::class => 'onAfterEntityPersistedEvent',
            AfterEntityUpdatedEvent::class => 'onAfterUpdatedPersistedEvent',
            AfterEntityDeletedEvent::class => 'onAfterDeletedPersistedEvent'
        ];
    }

    public function onAfterEntityPersistedEvent(AfterEntityPersistedEvent $event)
    {
        $this->requestStack->getSession()->getFlashBag()->add('success', 'La création a été réalisé avec succès');
    }

    public function onAfterUpdatedPersistedEvent(AfterEntityUpdatedEvent $event)
    {
        $this->requestStack->getSession()->getFlashBag()->add('success', 'La modification a été réalisé avec succès');
    }

    public function onAfterDeletedPersistedEvent(AfterEntityDeletedEvent $event)
    {
        $this->requestStack->getSession()->getFlashBag()->add('success', 'La suppressiona été réalisé avec succès');
    }
}