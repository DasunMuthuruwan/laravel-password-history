# Changelog

All notable changes to `devdasun/password-history` will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added
- Nothing yet.

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
- Laravel 13 support (`illuminate/*: ^13.0`), PHP `^8.3`.

[Unreleased]: https://github.com/DasunMuthuruwan/laravel-password-history/compare/v1.0.0...HEAD
[1.0.0]: https://github.com/DasunMuthuruwan/laravel-password-history/releases/tag/v1.0.0