# Changelog

This file contains the main changes for the Antheia library.

The file format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/).
This library uses [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.0.0] - 2025-12-30

### Breaking Changes
- Antheia 2.0.0 is not backward compatible with any 1.x.x release.
- JavaScript class naming conventions have changed:
  - All classes now use the `Antheia` prefix and follow standard JavaScript class naming
  - `ant_alert` → `AntheiaAlert`
  - `ant_confirm` → `AntheiaConfirm`
  - `ant_loading_step` → `AntheiaLoadingStep`
  - `ant_modal` → `AntheiaModal`
  - `ant_modalMenu` → `AntheiaModalMenu`
- Icon handling has been redesigned and is incompatible with previous versions.

### Changed
- The icon system has been redesigned. PNG icons remain supported, and SVG icons have been added as an additional format.
- JavaScript codebase has been aligned with consistent class naming conventions.

### Removed
- Material Icons dependency has been removed.

### Added
- Introduced a formal changelog following the Keep a Changelog specification.