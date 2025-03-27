# ~~WordPress Advanced Custom Fields~~ Lockr Stubs

This package provides stub declarations for ~~WordPress Advanced Custom Fields (ACF)~~ Lockr core functions, classes, interfaces, and global variables. These stubs can help plugin and theme developers leverage static analysis tools.

The stubs are generated directly from the [source](https://wpackagist.org/search?q=lockr&type=plugin&search=) using [giacocorsiglia/stubs-generator](https://github.com/GiacoCorsiglia/php-stubs-generator). Needless to say, this library repackages a subset of ~~WordPress ACF~~ Lockr code, which is the work of the ~~WordPress core ACF developers~~ Lockr. Granted, it's a useless subset without the real thing!

Many thanks to [GiacoCorsiglia](https://github.com/GiacoCorsiglia) and [paulthewalton](https://github.com/paulthewalton), who did all the hard work on [giacocorsiglia/wordpress-stubs](https://github.com/GiacoCorsiglia/wordpress-stubs) and [acf-stubs](https://github.com/paulthewalton/acf-stubs), from which this is shamelessly ripped off.

## Installation

Require this package as a dev-dependency with [Composer](https://getcomposer.org):

```
composer require --dev mccomaschris/lockr-stubs
```

Alternatively, you may download `lockr-stubs.php` directly.

## Usage for Intellisense

From Wordpress Stubs:

> If your editor has trouble parsing all of WordPress, you may find the stubs useful for enabling code completion and related features. For example, [here](https://github.com/bmewburn/vscode-intelephense/issues/113) are instructions for usage with VSCode's [Intelephense](https://marketplace.visualstudio.com/items?itemName=bmewburn.vscode-intelephense-client) extension. (In my experience, however, Intelephense parses WordPress core just fine.)

## Versioning

This package is versioned to match the Lockr version from which the stubs are generated. If any fixes to stubs are required, subsequent releases will be versioned as `LOCKR_VERSION.X`.

## Generating stubs for a different Lockr version

You should be running PHP 7.1 or later to follow these steps, so any function definitions that are polyfills for older versions of PHP are excluded from the stubs. Additionally, the Stubs Generator package at least requires PHP 7.1.

1. Clone this repository and `cd` into it.
2. Update `"wpackagist-plugin/lockr": "X.X.X"` in `composer.json` with your desired version.
3. Run `composer update`
4. Run `./generate.sh`

The `lockr-stubs.php` file should now be updated. Feel free to submit a Pull Request if you'd like to see a release for a newer version. If things have fallen behind, please generate stubs for each missing version in a distinct commit so we can have a continuous release history.
