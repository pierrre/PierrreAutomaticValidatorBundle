<?php

namespace Pierrre\AutomaticValidatorBundle\Util;

use Symfony\Component\Validator\Validator;

use Pierrre\AutomaticValidatorBundle\Exception\EntityValidationException;

class AutomaticValidator{
	/**
	 * @var Symfony\Component\Validator\Validator
	 */
	private $validator;
	
	/**
	 * @param Symfony\Component\Validator\Validator $validator
	 */
	public function __construct(Validator $validator){
		$this->validator = $validator;
	}
	
	/**
	 * @param Doctrine\ORM\Event\LifecycleEventArgs $args
	 * @throws Pierrre\AutomaticValidatorBundle\Exception\EntityValidationException
	 */
	public function validate($entity){
		$violations = $this->validator->validate($entity);
		
		if(count($violations) > 0){
			throw new EntityValidationException($entity, $violations);
		}
	}
}