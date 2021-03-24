<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class NflFastrSymfonyExtension extends Extension implements PrependExtensionInterface
{
	protected ContainerBuilder $container;

	protected array $config;

	public function prepend(ContainerBuilder $container)
	{
		$loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
		$loader->load('services.yaml');

		$configs = $container->getExtensionConfig($this->getAlias());
		$config = $this->processConfiguration(new Configuration(), $configs);

		$flysystemTemporaryStorage = [
			'nflfastrsymfony.temporarystorage' => [
				'adapter' => 'local',
				'options' => [
					'directory' => $container->getParameter('kernel.project_dir') . '/var/storage/tmp'
				]
			]
		];

		$container->prependExtensionConfig(
			'flysystem',
			['storages' => $flysystemTemporaryStorage]
		);
	}

	public function load(array $configs, ContainerBuilder $container)
	{
		$this->container = $container;

		$configuration = new Configuration();
		$this->config = $this->processConfiguration($configuration, $configs);

		$loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
		$loader->load('services.yaml');

		$definition = $container->getDefinition('nfl_fastr_symfony.resource_handler_service');
		$definition->setArgument('$sources', $this->config['sources']);

		$container->setParameter('nfl_fastr_symfony.sources', $this->config['sources']);
	}
}
