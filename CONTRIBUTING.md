# Contributing

## Updating TinyMCE

To update TinyMCE to a newer version, run the following commands:

```bash
# Remove existing TinyMCE files
rm -rf public/ext/tinymce public/ext/tinymce-webcomponent.js
# Download latest versions
npm update tinymce
npm update @tinymce/tinymce-webcomponent
# Copy dist files to public directory
cp -r node_modules/tinymce public/ext/tinymce
cp node_modules/@tinymce/tinymce-webcomponent/dist/tinymce-webcomponent.js public/ext/tinymce-webcomponent.js
# Reinstall additional skins
cp -r public/skins/ui/* public/ext/tinymce/skins/ui
cp -r public/skins/content/* public/ext/tinymce/skins/content
```


## Coding standards

Codign standards checks are run in the CI/CD pipelines.

You can also run these checks locally with the following commands:

- `composer run php-cs-fixer`
- `composer run phpstan`
- `composer run phpmd`
- `npm run lint:css`
- `npm run lint:js`

For more information about the actual standards, please refer to each tool's
configuration file(s).
