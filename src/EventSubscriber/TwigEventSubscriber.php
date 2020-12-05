<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use App\Repository\MenuRepository;
use Twig\Environment;

class TwigEventSubscriber implements EventSubscriberInterface
{
    private $twig;
    private $menuRepository;

    public function __construct(Environment $twig, MenuRepository $menuRepository)
    {
        $this->twig = $twig;
        $this->menuRepository = $menuRepository;
    }

    public function onKernelController(ControllerEvent $event)
    {
        // ...
        $this->twig->addGlobal('menu', $this->menuRepository->findAll());
    }

    public static function getSubscribedEvents()
    {
        return [
            'kernel.controller' => 'onKernelController',
        ];
    }
}
