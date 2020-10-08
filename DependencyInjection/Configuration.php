<?php

declare(strict_types=1);

namespace HansPeterOrding\NflfastrSymfonyBundle\DependecyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
	public function getConfigTreeBuilder()
	{
		$treeBuilder = new TreeBuilder('nflfastr_symfony');
		$rootNode = $treeBuilder->getRootNode();

		$rootNode
			->children()
				->scalarNode('timetone')->defaultValue('Europe/Berlin')->end()
				->arrayNode('sources')
					->children()
						->arrayNode('playByPlay')
							->useAttributeAsKey(true)
							->arrayPrototype()
								->children()
									->scalarNode('baseUrl')
										->defaultValue('https://github.com/guga31bb/nflfastR-data')
									->end()
									->scalarNode('path')
										->defaultValue('tree/master/data')
									->end()
								->end()
							->end()
						->end()
						->arrayNode('roster')
							->useAttributeAsKey(true)
							->arrayPrototype()
								->children()
									->scalarNode('baseUrl')
										->defaultValue('https://github.com/mrcaseb/nflfastR-roster')
									->end()
									->scalarNode('path')
										->defaultValue('tree/master/data/seasons')
									->end()
								->end()
							->end()
						->end()
					->end()
				->end()
			->end();

		return $treeBuilder;
	}
}
