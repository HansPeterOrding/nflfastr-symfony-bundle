<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;

class NflFastrSymfonyExtension extends Extension
{
	protected ContainerBuilder $container;

	protected array $config;

	public function load(array $configs, ContainerBuilder $container)
	{
		$this->container = $container;

		$configuration = new Configuration();
		$this->config = $this->processConfiguration($configuration, $configs);
	}
}
