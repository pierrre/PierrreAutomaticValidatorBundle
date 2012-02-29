<?php

namespace Pierrre\AutomaticValidatorBundle\Tests\Exception;

use Pierrre\AutomaticValidatorBundle\Exception\EntityValidationException;

use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;

class EntityValidationExceptionTest extends \PHPUnit_Framework_TestCase{
	/**
	 * @covers Pierrre\AutomaticValidatorBundle\Exception\EntityValidationException::__construct
	 */
	public function testConstruct(){
		$exception = $this->getException();
		
		$this->assertInstanceOf('Pierrre\AutomaticValidatorBundle\Exception\EntityValidationException', $exception);
	}
	
	/**
	 * @covers Pierrre\AutomaticValidatorBundle\Exception\EntityValidationException::getEntity
	 */
	public function testGetEntity(){
		$exception = $this->getException();
		$entity = $exception->getEntity();
		
		$this->assertInstanceOf('stdClass', $entity);
	}
	
	/**
	 * @covers Pierrre\AutomaticValidatorBundle\Exception\EntityValidationException::getViolations
	 */
	public function testGetViolations(){
		$exception = $this->getException();
		$violations = $exception->getViolations();
	
		$this->assertInstanceOf('Symfony\Component\Validator\ConstraintViolationList', $exception);
	}
	
	private function getException(){
		$entity = new \stdClass();
		
		$violation = new ConstraintViolation('Invalid', array(), 'entity', 'property', 'invalid');
		
		$violations = new ConstraintViolationList();
		$violations->add($violation);
		
		$exception = new EntityValidationException($entity, $violations);
		
		return $exception;
	}
}