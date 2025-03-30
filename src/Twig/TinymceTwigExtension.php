<?php

namespace EmilePerron\TinymceBundle\Twig;

use EmilePerron\TinymceBundle\Util\TinymceConfigurator;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\Markup;
use Twig\TwigFunction;

class TinymceTwigExtension extends AbstractExtension
{
    public function __construct(
        private TinymceConfigurator $tinymceConfigurator,
    ) {}

    /**
     * @return array<int,TwigFunction>
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('tinymce', [$this, 'tinymceEditor'], ['needs_environment' => true]),
            new TwigFunction('tinymce_scripts', [$this, 'tinymceScripts'], ['needs_environment' => true]),
            new TwigFunction('tinymce_attributes', [$this, 'tinymceAttributes']),
            new TwigFunction('tinymce_config_variable_name', [$this, 'tinymceConfigVariableName']),
        ];
    }

    /**
     * Merges the provided attributes with the default attributes defined in
     * the configuration.
     *
     * @param array<string,string> $customAttributes
     *
     * @return array<string,string> The merged attributes as a key => value array
     */
    public function tinymceAttributes(array $customAttributes = []): array
    {
        $globalAttributes = $this->tinymceConfigurator->getGlobalAttributes();

        return array_merge($globalAttributes, $customAttributes);
    }

    /**
     * Renders the two scripts for TinyMCE to prepare for injection of TinyMCE
     * editor in Javascript.
     */
    public function tinymceScripts(Environment $environment): Markup
    {
        $elementHtml = $environment->render('@Tinymce/twig/tinymce_scripts.html.twig');

        return new Markup($elementHtml, 'utf-8');
    }

    /**
     * @param array<string,string> $customAttributes
     */
    public function tinymceEditor(Environment $environment, mixed $data, array $customAttributes = []): Markup
    {
        $htmlAttributes = '';

        foreach ($this->tinymceAttributes($customAttributes) as $key => $value) {
            $htmlAttributes .= "$key=\"$value\" ";
        }

        $elementHtml = $environment->render('@Tinymce/twig/tinymce_editor.html.twig', [
            'data' => $data,
            'attributes' => new Markup($htmlAttributes, 'utf-8'),
        ]);

        return new Markup($elementHtml, 'utf-8');
    }

    /**
     * Returns the Javascript variable name for additional TinyMCE configurations.
     */
    public function tinymceConfigVariableName(): string
    {
        return $this->tinymceConfigurator->getGlobalAttributes()['config'] ?? 'tinymceAdditionalConfig';
    }
}
