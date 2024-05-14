<?php

namespace EmilePerron\TinymceBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
	public function getConfigTreeBuilder(): TreeBuilder
	{
		$treeBuilder = new TreeBuilder('tinymce');
		$rootNode = $treeBuilder->getRootNode();

		// Here you should define the parameters that are allowed to
		// configure your bundle. See the documentation linked above for
		// more information on that topic.
		$rootNode
			->children()
				->scalarNode('skin')->end()
				->scalarNode('content_css')->end()
				->scalarNode('content_style')->end()
				->scalarNode('plugins')->end()
				->scalarNode('toolbar')->end()
				->scalarNode('toolbar_mode')->end()
				->scalarNode('menubar')->end()
				->scalarNode('contextmenu')->end()
				->scalarNode('quickbars_insert_toolbar')->end()
				->scalarNode('quickbars_selection_toolbar')->end()
				->scalarNode('resize')->end()
				->scalarNode('icons')->end()
				->scalarNode('icons_url')->end()
				->scalarNode('images_upload_url')->end()
				->scalarNode('images_upload_route')->end()
				->arrayNode('images_upload_route_params')->end()
				->scalarNode('images_upload_handler')->end()
				->scalarNode('images_upload_base_path')->end()
				->scalarNode('images_upload_credentials')->end()
				->scalarNode('images_reuse_filename')->end()
				->scalarNode('powerpaste_word_import')->end()
				->scalarNode('powerpaste_html_import')->end()
				->scalarNode('powerpaste_allow_local_images')->end()
			->end();

		return $treeBuilder;
	}
}
