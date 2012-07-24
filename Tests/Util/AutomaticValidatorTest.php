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
		$container = $this->getMock('Symfony\Component\DependencyInjection\ContainerInterface');
		
		$automaticValidator = new AutomaticValidator($container);
		
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
		
		$container = $this->getMock('Symfony\Component\DependencyInjection\ContainerInterface');
		$container->expects($this->once())
				->method('get')
				->with('validator')
				->will($this->returnValue($validator));
		
		$automaticValidator = new AutomaticValidator($container);
		
		$automaticValidator->validate($entity);
	}
	
	/**
	 * @expectedException Pierrre\AutomaticValidatorBundle\Exception\ValidationException
	 * 
	 * @covers Pierrre\AutomaticValidatorBundle\Util\AutomaticValidator::validate
	 */
	public function testValidateWithEntityInvalid(){
		$entity = new \stdClass();
		
		$violation = new ConstraintViolation('Invalid', array(), 'entity', 'property', 'invalid');
		
		$violationList = new ConstraintViolationList();
		$violationList->add($violation);
		
		$validator = $this->getMock('Symfony\Component\Validator\ValidatorInterface');
		$validator->expects($this->once())
				->method('validate')
				->with($entity)
				->will($this->returnValue($violationList));
		
		$container = $this->getMock('Symfony\Component\DependencyInjection\ContainerInterface');
		$container->expects($this->once())
				->method('get')
				->with('validator')
				->will($this->returnValue($validator));
		
		$automaticValidator = new AutomaticValidator($container);
		
		$automaticValidator->validate($entity);
	}
}