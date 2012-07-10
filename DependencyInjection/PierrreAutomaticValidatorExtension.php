<?php

namespace Pierrre\AutomaticValidatorBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class PierrreAutomaticValidatorExtension extends Extension {
	/**
	 * @see Symfony\Component\DependencyInjection\Extension\ExtensionInterface::load()
	 */
	public function load(array $configs, ContainerBuilder $container){
		$loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
		$loader->load('services.yml');
		
		$config = $this->processConfiguration(new Configuration(), $configs);
		
		if($config['orm']) {
			$loader->load('orm.yml');
		}
	}
}