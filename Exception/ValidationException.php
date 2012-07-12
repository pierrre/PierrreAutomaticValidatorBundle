<?php

namespace Pierrre\AutomaticValidatorBundle\Exception;

use \Exception;

use Symfony\Component\Validator\ConstraintViolationList;

class ValidationException extends Exception{
	private $object;

	/**
	 * @var Symfony\Component\Validator\ConstraintViolationList
	 */
	private $violations;

	/**
	 * @param object $object
	 * @param Symfony\Component\Validator\ConstraintViolationList $violations
	 */
	public function __construct($object, ConstraintViolationList $violations){
		$this->object = $object;
		$this->violations = $violations;

		parent::__construct("Validation error:\n" . $this->violations);
	}

	/**
	 * @return object
	 */
	public function getObject(){
		return $this->object;
	}

	/**
	 * @return Symfony\Component\Validator\ConstraintViolationList
	 */
	public function getViolations(){
		return $this->violations;
	}
}