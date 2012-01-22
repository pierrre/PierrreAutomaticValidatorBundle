<?php

namespace Pierrre\AutomaticValidatorBundle\EventListener;

use Doctrine\ORM\Events;
use Doctrine\ORM\Event\LifecycleEventArgs;

use Pierrre\AutomaticValidatorBundle\Util\AutomaticValidator;

class DoctrineListener{
	/**
	 * @var Pierrre\AutomaticValidatorBundle\Util\AutomaticValidator
	 */
	private $automaticValidator;
	
	public function __construct(AutomaticValidator $automaticValidator){
		$this->automaticValidator = $automaticValidator;
	}
	
	/**
	 * @param Doctrine\ORM\Event\LifecycleEventArgs $args
	 */
	public function prePersist(LifecycleEventArgs $args){
		$this->automaticValidator->validate($args->getEntity());
	}
	
	/**
	 * @param Doctrine\ORM\Event\LifecycleEventArgs $args
	 */
	public function preUpdate(LifecycleEventArgs $args){
		$this->automaticValidator->validate($args->getEntity());
	}
}