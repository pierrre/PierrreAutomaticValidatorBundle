<?php

namespace Pierrre\AutomaticValidatorBundle\EventListener;

use Doctrine\ODM\MongoDB\Event\LifecycleEventArgs;

use Pierrre\AutomaticValidatorBundle\Util\AutomaticValidator;

class MongoDBListener{
	/**
	 * @var Pierrre\AutomaticValidatorBundle\Util\AutomaticValidator
	 */
	private $automaticValidator;
	
	/**
	 * @param Pierrre\AutomaticValidatorBundle\Util\AutomaticValidator $automaticValidator
	 */
	public function __construct(AutomaticValidator $automaticValidator){
		$this->automaticValidator = $automaticValidator;
	}
	
	/**
	 * @param Doctrine\ODM\MongoDB\Event\LifecycleEventArgs $eventArgs
	 */
	public function prePersist(LifecycleEventArgs $eventArgs) {
		$this->automaticValidator->validate($eventArgs->getDocument());
	}
	
	/**
	 * @param Doctrine\ODM\MongoDB\Event\LifecycleEventArgs $eventArgs
	 */
	public function preUpdate(LifecycleEventArgs $eventArgs) {
		$this->automaticValidator->validate($eventArgs->getDocument());
	}
}