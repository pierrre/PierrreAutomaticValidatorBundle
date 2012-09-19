<?php

namespace Pierrre\AutomaticValidatorBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ODM\MongoDB\Event\LifecycleEventArgs;
use Doctrine\ODM\MongoDB\Event\PreUpdateEventArgs;
use Doctrine\ODM\MongoDB\Events;

use Pierrre\AutomaticValidatorBundle\Util\AutomaticValidator;

class MongoDBListener implements EventSubscriber {
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
	
	public function getSubscribedEvents() {
		return array(
			Events::prePersist => 'prePersist',
			Events::preUpdate => 'preUpdate'
		);
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
	public function preUpdate(PreUpdateEventArgs $eventArgs) {
		$this->automaticValidator->validate($eventArgs->getDocument());
	}
}