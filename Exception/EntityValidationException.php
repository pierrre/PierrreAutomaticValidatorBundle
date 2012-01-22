<?php

namespace Pierrre\AutomaticValidatorBundle\Exception;

use \Exception;

use Symfony\Component\Validator\ConstraintViolationList;

class EntityValidationException extends Exception{
	private $entity;

	/**
	 * @var Symfony\Component\Validator\ConstraintViolationList
	 */
	private $violations;

	/**
	 * @param object $entity
	 * @param Symfony\Component\Validator\ConstraintViolationList $violations
	 */
	public function __construct($entity, ConstraintViolationList $violations){
		$this->entity = $entity;
		$this->violations = $violations;

		parent::__construct("Entity validation error:\n" . $this->violations);
	}

	/**
	 * @return object
	 */
	public function getEntity(){
		return $this->entity;
	}

	/**
	 * @return Symfony\Component\Validator\ConstraintViolationList
	 */
	public function getViolations(){
		return $this->violations;
	}
}