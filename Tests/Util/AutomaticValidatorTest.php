<?php

namespace Pierrre\AutomaticValidatorBundle\Tests\Util;

use Pierrre\AutomaticValidatorBundle\Util\AutomaticValidator;

use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;

class AutomaticValidatorTest extends \PHPUnit_Framework_TestCase{
	/**
	 * @covers Pierrre\AutomaticValidatorBundle\Util\AutomaticValidator::__construct
	 */
	public function testContruct(){
		$validator = $this->getMock('Symfony\Component\Validator\ValidatorInterface');
		
		$automaticValidator = new AutomaticValidator($validator);
		
		$this->assertInstanceOf('Pierrre\AutomaticValidatorBundle\Util\AutomaticValidator', $automaticValidator);
	}
	
	/**
	 * @covers Pierrre\AutomaticValidatorBundle\Util\AutomaticValidator::validate
	 */
	public function testValidate(){
		$entity = new \stdClass();
		
		$violationList = new ConstraintViolationList();
		
		$validator = $this->getMock('Symfony\Component\Validator\ValidatorInterface');
		$validator->expects($this->once())
				->method('validate')
				->with($entity)
				->will($this->returnValue($violationList));
		
		$automaticValidator = new AutomaticValidator($validator);
		
		
		
		$automaticValidator->validate($entity);
	}
	
	/**
	 * @expectedException Pierrre\AutomaticValidatorBundle\Exception\EntityValidationException
	 * 
	 * @covers Pierrre\AutomaticValidatorBundle\Util\AutomaticValidator::validate
	 */
	public function testValidateWithEntityInvalid(){
		$entity = new \stdClass();
		
		$violation = new ConstraintViolation('Invalid', array(), 'entity', 'property', 'invalid');
		
		$violationList = new ConstraintViolationList(array($violation));
		
		$validator = $this->getMock('Symfony\Component\Validator\ValidatorInterface');
		$validator->expects($this->once())
				->method('validate')
				->with($entity)
				->will($this->returnValue($violationList));
		
		$automaticValidator = new AutomaticValidator($validator);
		
		$automaticValidator->validate($entity);
	}
}