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
		$rootnode = $treeBuilder->root('pierrre_automatic_validator');
		
		$rootnode
			->children()
				->scalarNode('orm')
					->defaultValue(false)
				->end()
			->end()
		->end();
		
		return $treeBuilder;
	}
}
