<?php

namespace Pierrre\AutomaticValidatorBundle\Tests\Exception;

use Pierrre\AutomaticValidatorBundle\Exception\ValidationException;

use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;

class ValidationExceptionTest extends \PHPUnit_Framework_TestCase{
	/**
	 * @covers Pierrre\AutomaticValidatorBundle\Exception\ValidationException::__construct
	 */
	public function testConstruct(){
		$exception = $this->getException();
		
		$this->assertInstanceOf('Pierrre\AutomaticValidatorBundle\Exception\ValidationException', $exception);
	}
	
	/**
	 * @covers Pierrre\AutomaticValidatorBundle\Exception\ValidationException::getObject
	 */
	public function testGetObject(){
		$exception = $this->getException();
		$object = $exception->getObject();
		
		$this->assertInstanceOf('stdClass', $object);
	}
	
	/**
	 * @covers Pierrre\AutomaticValidatorBundle\Exception\ValidationException::getViolations
	 */
	public function testGetViolations(){
		$exception = $this->getException();
		$violations = $exception->getViolations();
	
		$this->assertInstanceOf('Symfony\Component\Validator\ConstraintViolationList', $violations);
	}
	
	private function getException(){
		$object = new \stdClass();
		
		$violation = new ConstraintViolation('Invalid', array(), 'entity', 'property', 'invalid');
		
		$violations = new ConstraintViolationList();
		$violations->add($violation);
		
		$exception = new ValidationException($object, $violations);
		
		return $exception;
	}
}