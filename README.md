# TinyMCE for your Symfony apps and forms

This is a fork of [eckinox/tinymce-bundle](https://github.com/eckinox/tinymce-bundle).
Both packages were created by myself, but since I left Eckinox the original
bundle has been treated more like an internal package rather than a public &
open-source package, so I created this fork to keep supporting the community.

## Getting started

### 1. Install this package via Composer

```bash
composer require emileperron/tinymce-bundle
```

### 2. Start using TinyMCE!

#### Using TinyMCE in Symfony forms

Adding a TinyMCE editor in your Symfony forms works like any other form types:


```php
use EmilePerron\TinymceBundle\Form\Type\TinymceType;

public function buildForm(FormBuilderInterface $builder, array $options): void
{
    $builder->add("comment", TinymceType::class, [
        "attr" => [
            "toolbar" => "bold italic underline | bullist numlist",
        ],
    ])
    // ...
```

#### Using TinyMCE in templates

To render a TinyMCE editor in Twig without using Symfony forms, you can use the
`tinymce()` Twig function that is provided by this bundle.

Simply provide the value as the first argument and you're good to go.

You can also use the second argument to specify attributes to add to the element.

Here is an example:

```twig
{{ tinymce("<p>This is a note</p>", { name: "notes", skin: "oxide" }) }}
```

#### Using TinyMCE in Javascript

To render a TinyMCE editor in Javascript, first ensure that the main TinyMCE script
is loaded.

If you already use the `tinymce()` Twig function or the `TinymceType` on the page,
the scripts are already loaded. Otherwise, you can include them on the page either
by adding the following scripts manually:

```html
<script src="{{ asset('bundles/tinymce/ext/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('bundles/tinymce/ext/tinymce-webcomponent.js') }}" type="module"></script>
```

or by using the `tinymce_scripts()` function like so:
```twig
{{ tinymce_scripts() }}
```

Then, all you have to do is add a TinyMCE editor web element on the page with the
desired attributes and value.

Here's is an example:

```js
const contentText = document.createTextNode("<p>Your original text goes here</p>");
const editor = document.createElement("tinymce-editor");

editor.append(contentText);
editor.setAttribute("skin", "appstack");

// If you want to use your default configurations, uncomment this
/*
const attrs = {{ tinymce_attributes({ menubar: "format" })|json_encode|raw }};

for (const key in attrs) {
	editor.setAttribute(key, attrs[key]);
}
*/

// Add the editor to the page
document.body.append(editor);
```

You can refer to [Tiny's web component documentation](https://www.tiny.cloud/docs/tinymce/6/webcomponent-ref)
for more information.


## Configuring TinyMCE

This bundle includes and uses the web component version of TinyMCE.

You can configure TinyMCE by setting HTML attributes on the editor element itself (`<tinymce-editor>`).

When using the form type, you can use the `attr` option to set the attributes.
For example, you can set the toolbar's actions like so:

```php
use EmilePerron\TinymceBundle\Form\Type\TinymceType;

public function buildForm(FormBuilderInterface $builder, array $options): void
{
    $builder->add("comment", TinymceType::class, [
        "attr" => [
            "toolbar" => "bold italic underline | bullist numlist",
        ],
    ])
    // ...
```

For more information on the different configurations that TinyMCE offers, refer
to [Tiny's web component documentation](https://www.tiny.cloud/docs/tinymce/6/webcomponent-ref/).

### Default configurations

You can set the following default options in a configuration file:

```yaml
tinymce:
    # The configurations mirror the TinyMCE attributes.
    # Learn more about each option in Tiny's documentation:
    # https://www.tiny.cloud/docs/tinymce/6/webcomponent-ref/
    skin: "oxide"
    content_css: "default"
    content_style: ""
    config: "tinymceAdditionalConfig"
    plugins: "advlist autolink link image media table lists"
    toolbar: "bold italic underline | bullist numlist"
    toolbar_mode: ""
    menubar: ""
    contextmenu: ""
    quickbars_insert_toolbar: ""
    quickbars_selection_toolbar: ""
    resize: ""
    icons: ""
    icons_url: ""
    setup: ""
    images_upload_url: "https://yoursite.com/upload"
    images_upload_route: ""
    images_upload_route_params: []
    images_upload_handler: ""
    images_upload_base_path: ""
    images_upload_credentials: "true"
    images_reuse_filename: ""
    powerpaste_word_import: ""
    powerpaste_html_import: ""
    powerpaste_allow_local_images: ""
```

#### Using your configuration in Twig templates

If you need to use your configurations in a Twig template, you can use the
`tinymce_attributes()` function, which accepts an optional array of custom
attributes that take priority over the default configuration.

Here is an example:

```js
const attrs = {{ tinymce_attributes({ menubar: "format" })|json_encode|raw }};

for (const key in attrs) {
	editor.setAttribute(key, attrs[key]);
}
```

### File uploads (optional)

File uploads are not handled by default, as the process will vary from project to project.

To set this up, take a look at [Tiny's web component file upload documentation](https://www.tiny.cloud/docs/tinymce/6/webcomponent-ref/#setting-the-images-upload-url).

To help you get started, we have provided an example of what the implementation may look like.
You can find this example in [`docs/file-upload-example.md`](./docs/file-upload-example.md).

## Commercial TinyMCE License Key

By default, this bundle sets you up to use the GPL licensed version of TinyMCE.

If you have a commercial license that you would like to use instead, you must
provide the `license_key` to the global TinyMCE configuration extras, like so:

```js
window.tinymceAdditionalConfig = {
	license_key: "<your-license-key-here>",
};
```

## AssetMapper support

Support for Symfony's AssetMapper is built-in to this bundle since v2.1. No
additional configuration is required on your end.

When AssetMapper is used, the TinyMCE files are automatically excluded from
being compiled as part of Asset Mapper, as the versioning hash that Asset
Mapper automatically adds to filenames and URLs is incompatible with the
runtime script imports that are core to TinyMCE.


## AppStack skin

This bundle comes with an `appstack` skin, which matches the style of the
[AppStack Bootstrap template](https://appstack-bs5.bootlab.io/index.html).

This skin is an extension of the tinymce-5, and it has dark mode support built-in.

To use it, simply specify it in your configuration:
```yaml
# config/packages/tinymce.yaml
tinymce:
    skin: appstack
    content_css: appstack
```


## Versions

| Bundle version | TinyMCE version | TinyMCE Web Component version |
|----------------|-----------------|-------------------------------|
| **3.0**        | 7.5.1           | 2.1.0                         |
| **2.1**        | 6.8.5           | 2.1.0                         |
| **2.0**        | 6.8.3           | 2.1.0                         |
| For prior versions, refer to [eckinox/tinymce-bundle](https://github.com/eckinox/tinymce-bundle) |


## Contributing

Feel free to submit issues and PRs to the [emileperron/tinymce-bundle](https://github.com/EmilePerron/tinymce-bundle) repository on GitHub.

For more information on how to contribute, check out [CONTRIBUTING.md](./CONTRIBUTING.md).


## License

This bundle is distributed under the MIT license.

[TinyMCE](https://github.com/tinymce/tinymce) and the [TinyMCE web component](https://github.com/tinymce/tinymce-webcomponent) are developed and distributed by [Tiny®](https://www.tiny.cloud/) under the MIT license.
