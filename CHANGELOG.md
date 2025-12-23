# Changelog

This file contains the main changes for the Antheia library.

The file format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/).
This library uses [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.0.0] - YYYY-MM-DD

### Breaking Changes
- Antheia **2.0.0 is not backward compatible** with 1.x.x.
- JavaScript class naming conventions have changed:
  - All classes now use the `Antheia` prefix and follow standard JavaScript class naming
  - Example: `ant_alert` → `AntheiaAlert`
- Icon handling has been redesigned and is incompatible with previous versions.

### Changed
- Icons are implemented using the previous PNG system and a new vector-based SVG assets bundled with the library.
- JavaScript codebase has been aligned with consistent class naming conventions.

### Removed
- Material Icons dependency has been removed.

### Added
- This changelog file was introduced starting with version 2.0.0.