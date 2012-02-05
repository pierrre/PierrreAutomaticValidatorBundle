<?php

namespace Pierrre\AutomaticValidatorBundle\Util;

use Pierrre\AutomaticValidatorBundle\Exception\EntityValidationException;

use Symfony\Component\Validator\ValidatorInterface;

class AutomaticValidator{
	/**
	 * @var Symfony\Component\Validator\ValidatorInterface
	 */
	private $validator;
	
	/**
	 * @param Symfony\Component\Validator\ValidatorInterface $validator
	 */
	public function __construct(ValidatorInterface $validator){
		$this->validator = $validator;
	}
	
	/**
	 * @param object $entity
	 * @throws Pierrre\AutomaticValidatorBundle\Exception\EntityValidationException
	 */
	public function validate($entity){
		$violations = $this->validator->validate($entity);
		
		if(count($violations) > 0){
			throw new EntityValidationException($entity, $violations);
		}
	}
}