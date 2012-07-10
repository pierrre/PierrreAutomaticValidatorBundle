<?php

namespace Pierrre\AutomaticValidatorBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface {
	/**
	 * @see Symfony\Component\Config\Definition.ConfigurationInterface::getConfigTreeBuilder()
	 */
	public function getConfigTreeBuilder(){
		$treeBuilder = new TreeBuilder();
		
		$treeBuilder->root('pierrre_automatic_validator')
		;
		
		return $treeBuilder;
	}
}
