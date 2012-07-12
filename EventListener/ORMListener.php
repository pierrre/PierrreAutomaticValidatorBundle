<?php

namespace Pierrre\AutomaticValidatorBundle\EventListener;

use Doctrine\ORM\Events;
use Doctrine\ORM\Event\LifecycleEventArgs;

use Pierrre\AutomaticValidatorBundle\Util\AutomaticValidator;

class ORMListener{
	/**
	 * @var Pierrre\AutomaticValidatorBundle\Util\AutomaticValidator
	 */
	private $automaticValidator;
	
	public function __construct(AutomaticValidator $automaticValidator){
		$this->automaticValidator = $automaticValidator;
	}
	
	/**
	 * @param Doctrine\ORM\Event\LifecycleEventArgs $eventArgs
	 */
	public function prePersist(LifecycleEventArgs $eventArgs){
		$this->automaticValidator->validate($eventArgs->getEntity());
	}
	
	/**
	 * @param Doctrine\ORM\Event\LifecycleEventArgs $args
	 */
	public function preUpdate(LifecycleEventArgs $eventArgs){
		$this->automaticValidator->validate($eventArgs->getEntity());
	}
}