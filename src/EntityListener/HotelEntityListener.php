<?php
//namespace App\EntityListener;

//use App\Entity\Hotel;
//use Doctrine\ORM\Event\LifecycleEventArgs;
//use Symfony\Component\String\Slugger\SluggerInterface;

// src/EventListener/DatabaseActivitySubscriber.php
namespace App\EntityListener;

use App\Entity\Hotel;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class HotelEntityListener implements EventSubscriber
{
    private $slugger;
    //private $hotel;

    public function __construct(SluggerInterface $slugger)
    {
            $this->slugger = $slugger;
            //$this->hotel = new Hotel();
    }
    // this method can only return the event names; you cannot define a
    // custom method name to execute when each event triggers
    public function getSubscribedEvents(): array
    {
        return [
            Events::prePersist,
            Events::preUpdate,
        ];
    }

    // callback methods must be called exactly like the events they listen to;
    // they receive an argument of type LifecycleEventArgs, which gives you access
    // to both the entity object of the event and the entity manager itself
    public function prePersist(LifecycleEventArgs $args): void
    {
        //$args->getObject()->computeSlug($this->slugger);
    }

    public function preUpdate(LifecycleEventArgs $args): void
    {
        //dump($args); die();
        //$args->getObject()->computeSlug($this->slugger);
    }
}

/*
class HotelEntityListener
{
private $slugger;

public function __construct(SluggerInterface $slugger)
{
$this->slugger = $slugger;
}

public function prePersist(Hotel $hotel, LifecycleEventArgs $event)
{
$hotel->computeSlug($this->slugger);
}

public function preUpdate(Hotel $hotel, LifecycleEventArgs $event)
{
$hotel->computeSlug($this->slugger);
}
}
*/
