<?php

namespace Pierrre\AutomaticValidatorBundle\Util;

use Pierrre\AutomaticValidatorBundle\Exception\ValidationException;

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
	 * @param object $object
	 * @throws Pierrre\AutomaticValidatorBundle\Exception\EntityValidationException
	 */
	public function validate($object){
		$violations = $this->validator->validate($object);
		
		if(count($violations) > 0){
			throw new ValidationException($object, $violations);
		}
	}
}