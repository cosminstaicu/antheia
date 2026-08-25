# Changelog

This file contains the main changes for the Antheia library.

The file format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/).
This library uses [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [3.1.1] - 2026-08-25

### Changed

 * Small visual improvement: selected tabs now have a left, top, right border, to increase visibility on different backgrounds

## [3.1.0] - 2026-06-09

### Added

* Additional HTML customization support for Wireframe components:

  * Dividers in WireframeInfo and WireframeInput (and corresponding Panels) now support HTML id, CSS classes and test IDs.
  * Rows in WireframeInfo and WireframeInput (and corresponding Panels) now support HTML id, CSS classes and test IDs.
  * The "More options" button now supports HTML id, CSS classes and test IDs.

## [3.0.2] - 2026-05-27

### Fixed

* Cache folder REALLY uses the version number, instead of falling back to 0.0.0

### Added

* Added a test for `changelog.md` validation

## [3.0.1] - 2026-05-26

### Fixed

* Cache folder correctly uses the version number, instead of falling back to 0.0.0

### Changed

* Number type inputs have wheel event disabled, so the user can not change the input value by mistake

## [3.0.0] - 2026-05-14

### Breaking Changes

* The Composer package name has changed:

  * `antheia/antheia` → `antheia/framework`
* The PHP namespace root has changed:

  * `Antheia\Antheia\` → `Antheia\Framework\`
* Also, classes are contained inside the root namespace:

  * `Antheia\Antheia\Classes\` → `Antheia\Framework\`
  * `Antheia\Framework\Classes\` → `Antheia\Framework\`
* Antheia 3.0.0 is not backward compatible with any 2.x.x release.

### Migration

* Update Composer dependencies:

```bash
composer remove antheia/antheia
composer require antheia/framework
```

* Replace namespace imports in your project:

```php
Antheia\Antheia\Classes\
```

with:

```php
Antheia\Framework\
```

* Replace remaining legacy namespace references:

```php
Antheia\Antheia\
```

with:

```php
Antheia\Framework\
```

* In most projects, migration can be completed with a global search-and-replace operation.

### Changed

* The namespace structure has been reorganized to support future ecosystem expansion and additional Antheia packages.
* Composer package structure has been aligned with the new ecosystem naming convention.

### Removed

* The `Classes` namespace segment has been removed from the public API surface.

## [2.0.3] - 2026-01-26

### Added

* Toggle buttons in accordion search results now expose test IDs by default.

### Changed

* README.md has been updated for clarity.

## [2.0.2] - 2026-01-14

### Added

* E2E test status for the main branch is displayed as a badge in the README file.
* Search results action button inside a PageSearchResult render now exposes test IDs by default to improve end-to-end testing.

## [2.0.1] - 2026-01-05

### Added

* Fixed buttons (`FixedButtonAdd`, `FixedButtonBack`, etc.) now expose test IDs by default to improve end-to-end testing.

### Changed

* End-to-end tests now define explicit permissions where required.

### Fixed

* The “delete all” button in search modals (search-type inputs) now renders correctly.
* File drop animation for `inputFileDrop` form elements now works as expected.
* Icons inside input HTML elements have been adjusted to a smaller, consistent size.
* Ensured all files end with a trailing newline.

## [2.0.0] - 2025-12-30

### Breaking Changes

* Antheia 2.0.0 is not backward compatible with any 1.x.x release.
* JavaScript class naming conventions have changed:

  * All classes now use the `Antheia` prefix and follow standard JavaScript class naming.
  * `ant_alert` → `AntheiaAlert`
  * `ant_confirm` → `AntheiaConfirm`
  * `ant_loading_step` → `AntheiaLoadingStep`
  * `ant_modal` → `AntheiaModal`
  * `ant_modalMenu` → `AntheiaModalMenu`
* Icon handling has been redesigned and is incompatible with previous versions.

### Changed

* The icon system has been redesigned. PNG icons remain supported, and SVG icons have been added as an additional format.
* JavaScript codebase has been aligned with consistent class naming conventions.

### Removed

* Material Icons dependency has been removed.

### Added

* Introduced a formal changelog following the Keep a Changelog specification.
