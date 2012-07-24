<?php

namespace Pierrre\AutomaticValidatorBundle\Util;

use Pierrre\AutomaticValidatorBundle\Exception\ValidationException;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Validator\ValidatorInterface;

class AutomaticValidator {
	/**
	 * @var Symfony\Component\DependencyInjection\ContainerInterface
	 */
	private $container;
	
	/**
	 * @var Symfony\Component\Validator\ValidatorInterface
	 */
	private $validator;
	
	/**
	 * @param Symfony\Component\Validator\ValidatorInterface $validator
	 */
	public function __construct(ContainerInterface $container) {
		$this->container = $container;
		$this->validator = null;
	}
	
	/**
	 * @param object $object
	 * 
	 * @throws Pierrre\AutomaticValidatorBundle\Exception\EntityValidationException
	 */
	public function validate($object) {
		$violations = $this->getValidator()->validate($object);
		
		if(count($violations) > 0){
			throw new ValidationException($object, $violations);
		}
	}
	
	/**
	 * @return Symfony\Component\Validator\ValidatorInterface
	 */
	private function getValidator() {
		if(!isset($this->validator)) {
			$this->validator = $this->container->get('validator');
		}
		
		return $this->validator;
	}
}