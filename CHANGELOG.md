# Changelog

All notable changes to `devdasun/password-history` will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added
- Nothing yet.

## [2.0.0] - 2026-07-30

### Changed
- **Breaking:** minimum PHP version raised to `^8.3`.
- **Breaking:** minimum supported Laravel version raised to `^13.0`.
- Bumped `illuminate/*` to `^13.0` and `orchestra/testbench` to `^10.0`.

### Fixed
- Translations now load on every request, not just console commands (previously `loadTranslationsFrom()` was incorrectly scoped inside `runningInConsole()`).

---

---

## [1.0.0] - 2026-07-30

### Added
- Initial release.
- `HasPasswordHistory` trait with `recordPasswordHistory()` and `passwordWasUsedBefore()`.
- `DifferentFromHistory` validation rule, blocking reuse of recent passwords.
- Polymorphic `password_histories` table — works with `User` or any Eloquent model (`Admin`, `Customer`, etc.), not tied to a single `users` table.
- Configurable history limit via `config/password-history.php` (`PASSWORD_HISTORY_LIMIT` env var), default `5`.
- Publishable migration, config, and language files.
- `password-history:prune` console command for scheduled cleanup of history beyond the configured limit.
- Laravel 1 support (`illuminate/*: ^12.0`), PHP `^8.2`.

[Unreleased]: https://github.com/DasunMuthuruwan/laravel-password-history/compare/v1.0.0...HEAD
[1.0.0]: https://github.com/DasunMuthuruwan/laravel-password-history/releases/tag/v1.0.0