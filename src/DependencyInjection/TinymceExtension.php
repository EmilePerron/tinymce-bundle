<?php

namespace EmilePerron\TinymceBundle\DependencyInjection;

use EmilePerron\TinymceBundle\Util\TinymceConfigurator;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Extension\Extension;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class TinymceExtension extends Extension implements PrependExtensionInterface
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../../config'));
        $loader->load('services.yaml');

        $configuration = new Configuration();
        $tinymceConfig = $this->processConfiguration($configuration, $configs);

        $container
            ->getDefinition(TinymceConfigurator::class)
            ->addArgument($tinymceConfig)
        ;
    }

    public function prepend(ContainerBuilder $container): void
    {
        $container->prependExtensionConfig('twig', [
            'form_themes' => [
                '@Tinymce/form/tinymce_type.html.twig',
            ],
        ]);

        if (class_exists(\Symfony\Component\AssetMapper\AssetMapper::class)) {
            $container->prependExtensionConfig('framework', [
                'asset_mapper' => [
                    'excluded_patterns' => [
                        '**/**tinymce**',
                        '**/skins/*/appstack**',
                    ],
                ],
            ]);
        }
    }
}
