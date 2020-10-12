<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class NflFastrSymfonyExtension extends Extension
{
	protected ContainerBuilder $container;

	protected array $config;

	public function load(array $configs, ContainerBuilder $container)
	{
		$this->container = $container;

		$configuration = new Configuration();
		$this->config = $this->processConfiguration($configuration, $configs);

		$loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
		$loader->load('services.yaml');

		$definition = $container->getDefinition('nfl_fastr_symfony.import_roster_command');

		dump($definition->getArguments());
		$definition->setArgument(0, $this->config['sources']);

		dump($definition);

		$container->setParameter('nfl_fastr_symfony.sources', $this->config['sources']);
	}
}
