# Antheia
Responsive web interface for web apps, written in PHP.

![GitHub](https://img.shields.io/github/license/cosminstaicu/antheia)
![GitHub release (latest by date)](https://img.shields.io/github/v/release/cosminstaicu/antheia?display_name=tag)
![Website](https://img.shields.io/website?down_message=Offline&up_message=Online&url=https%3A%2F%2Fantheia.voipit.ro)
![Website](https://img.shields.io/packagist/dependency-v/antheia/antheia/php)

![03](https://user-images.githubusercontent.com/25685804/196055946-53d4f73d-f524-465d-adee-c9c762bb61a1.png)

A live example of the interface can be checked at [antheia.voipit.ro](https://antheia.voipit.ro). There you can find the content of the `examples` folder.

Please check the [project wiki](https://github.com/cosminstaicu/antheia/wiki) for more details about the library.

The main project using this library is the Cloud PBX Service, called Accolades and provided by [VoIPIT Romania](https://www.voipit.ro).

## Installation

Use [composer](https://getcomposer.org) to install Antheia into your project:

```sh
composer require antheia/antheia
```

After the installation you need to set up a cache folder for the library. This folder must have a corresponding URL path and the library needs to have write permission on it. The folder can be set up, at runtime using the dedicated method: `Globals::setCache(string $url, string $path)`.

## Documentation

All code is documented using the PHPDoc standard, so fell free to use content assist, depending of your IDE (the library is written using [Eclipse PDT](https://www.eclipse.org/pdt/)). Also, the javascript files are documented using the JSDoc standard.

The examples (inside the example folder) are explained inside the [project wiki](https://github.com/cosminstaicu/antheia/wiki).

## Credits

Icons used by the framework are provided freely by
 - [IO Broker icons](https://github.com/ioBroker/ioBroker.icons-fatcow-hosting)
 - [Lucide Icons](https://github.com/lucide-icons/lucide)

Color schemes for the predefined themes are provided freely by [Scheme Color](https://www.schemecolor.com).

Images used by the framework are provided freely by [Unsplash](https://unsplash.com).

# Licence

Antheia is licensed under [Apache-2.0](https://github.com/cosminstaicu/antheia/blob/master/LICENSE).
