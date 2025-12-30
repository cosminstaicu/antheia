# Antheia
A PHP library for building responsive, component-based web interfaces, designed for server-rendered web applications.

> ⚠️ Antheia 2.x is a major release with breaking changes. Versions 1.x.x are no longer supported. Please review the changelog before upgrading.

![GitHub](https://img.shields.io/github/license/cosminstaicu/antheia)
![GitHub release (latest by date)](https://img.shields.io/github/v/release/cosminstaicu/antheia?display_name=tag)
![Live Demo](https://img.shields.io/website?down_message=Offline&up_message=Online&url=https%3A%2F%2Fantheia.voipit.ro)
![PHP Version](https://img.shields.io/packagist/dependency-v/antheia/antheia/php)

![03](https://user-images.githubusercontent.com/25685804/196055946-53d4f73d-f524-465d-adee-c9c762bb61a1.png)

A live example of the interface (based on the current major version) is available at [antheia.voipit.ro](https://antheia.voipit.ro).  
The demo uses the content from the `examples` folder.

Please check the [project wiki](https://github.com/cosminstaicu/antheia/wiki) for more details about the library.

Antheia is used in production by the Cloud PBX service **Accolades**, provided by [VoIPIT Romania](https://www.voipit.ro).

## Installation

Use [composer](https://getcomposer.org) to install Antheia into your project:

```sh
composer require antheia/antheia
```

After installation, you must configure a cache folder for Antheia.

The cache folder:
- must be writable by the application
- must have a corresponding public URL
- should not be publicly writable beyond what Antheia requires

You can configure it at runtime using:

```php
Globals::setCache(string $url, string $path);
```

Failing to configure the cache correctly will result in runtime errors.

## Quick Start

```php
require __DIR__ . '/vendor/autoload.php';
use Antheia\Globals;
use Antheia\Page\PageEmpty;
// set up the cache folder
Globals::setCache('/cache', __DIR__ . '/public/cache');
// create a new empty page
$page = new PageEmpty();
// output the page content
echo $page->getHtml();
```

This will render a minimal, empty Antheia page and output the generated HTML.

## Supported Versions

- **2.x.x** — actively maintained
- **1.x.x** — end of life, no longer supported

## Documentation

All PHP code is documented using the PHPDoc standard. Most IDEs can provide code completion and inline documentation (the library is developed using [Eclipse PDT](https://www.eclipse.org/pdt/)).

JavaScript files are documented using the JSDoc standard.

Examples located in the `examples` folder are explained in detail in the
[project wiki](https://github.com/cosminstaicu/antheia/wiki).

For upgrade notes and breaking changes introduced in 2.0.0, please refer to the changelog.

## Security

Please review our [Security Policy](SECURITY.md) for reporting vulnerabilities.

## Credits

Icons used by the framework are provided freely by
 - [IO Broker icons](https://github.com/ioBroker/ioBroker.icons-fatcow-hosting)
 - [Lucide Icons](https://github.com/lucide-icons/lucide)

Color schemes for the predefined themes are provided freely by [Scheme Color](https://www.schemecolor.com).

Images used by the framework are provided freely by [Unsplash](https://unsplash.com).

# License

Antheia is licensed under [Apache-2.0](https://github.com/cosminstaicu/antheia/blob/main/LICENSE).
