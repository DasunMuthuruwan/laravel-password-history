# Contributing

Thanks for considering contributing to Password History! Contributions of all kinds are welcome — bug reports, bug fixes, new features, documentation improvements, and tests.

## Code of Conduct

Be respectful and constructive. Disagreements about code are fine; personal attacks are not.

## Reporting Bugs

Before opening an issue, please check the [existing issues](https://github.com/DevDasun/password-history/issues) to avoid duplicates.

A good bug report includes:

- Laravel version (`php artisan --version`)
- PHP version (`php -v`)
- Package version (`composer show devdasun/password-history`)
- Steps to reproduce
- What you expected to happen vs. what actually happened
- A minimal code sample, if possible

## Suggesting Features

Open an issue describing:

- The problem you're trying to solve
- Your proposed solution
- Any alternatives you've considered

Not every suggestion will be accepted — this is a small, focused package, and we'd rather keep it that way than grow scope creep.

## Development Setup

1. Fork the repository and clone your fork:

   ```bash
   git clone https://github.com/DasunMuthuruwan/laravel-password-history.git
   cd password-history
   ```

2. Install dependencies:

   ```bash
   composer install
   ```

3. (Optional) Link the package into a local Laravel 13 app for manual testing — see the [path repository section](README.md) or:

   ```json
   "repositories": [
       { "type": "path", "url": "../password-history" }
   ],
   "require": {
       "devdasun/password-history": "*"
   }
   ```

   ```bash
   composer require devdasun/password-history:*
   ```

## Running Tests

The test suite uses [Orchestra Testbench](https://github.com/orchestral/testbench) and PHPUnit.

```bash
composer test
```

Or directly:

```bash
./vendor/bin/phpunit
```

Run a single test:

```bash
./vendor/bin/phpunit --filter=test_password_cannot_be_reused
```

### Test coverage

If you add new behavior, add a test for it. PRs without test coverage for new functionality will likely be asked to add some before merging.

## Coding Standards

This package follows [PSR-12](https://www.php-fig.org/psr/psr-12/) and Laravel's general conventions (typed properties, constructor property promotion where sensible, `declare(strict_types=1)` not required but welcome).

If [Laravel Pint](https://github.com/laravel/pint) is installed:

```bash
composer require --dev laravel/pint
./vendor/bin/pint
```

Run it before committing to avoid style-only diff noise in your PR.

## Static Analysis

If PHPStan/Larastan is configured in the repo:

```bash
./vendor/bin/phpstan analyse
```

Please don't introduce new baseline-ignored errors.

## Pull Request Process

1. Create a feature branch from `main`:

   ```bash
   git checkout -b feature/short-description
   ```

2. Make your changes, with tests.
3. Run the full test suite and code style checks locally — CI will run the same checks, but catching issues early saves round-trips.
4. Update `README.md` if you've changed public behavior or configuration.
5. Add an entry under `[Unreleased]` in `CHANGELOG.md` (see format below).
6. Commit with a clear message (e.g. `Fix: prevent duplicate history entries on rapid password changes`).
7. Push to your fork and open a PR against `main`.
8. Fill in the PR description: what changed, why, and how it was tested.

### Changelog entries

Add your change to `CHANGELOG.md` under `[Unreleased]`, in the appropriate category:

```markdown
## [Unreleased]

### Added
- Your new feature, briefly described.

### Fixed
- Your bug fix, briefly described.
```

Don't bump the version number yourself — that happens at release time.

### Commit messages

No strict convention enforced, but please:

- Use the imperative mood ("Add X" not "Added X" or "Adds X")
- Keep the summary line under ~72 characters
- Reference the issue number if applicable (`Fixes #12`)

## What Gets Merged

PRs are more likely to be accepted quickly if they:

- Do one thing (avoid bundling unrelated changes)
- Include tests for new behavior or regression tests for bug fixes
- Don't introduce new required dependencies without discussion first
- Keep backward compatibility, or clearly call out a breaking change and why it's necessary

## Supported Versions

Contributions should target the versions listed in [README.md](README.md#requirements) (currently PHP ^8.3, Laravel ^13.0). If you need to support an older Laravel version, please open an issue to discuss before submitting a PR — it may require a separate branch/release line.

## License

By contributing, you agree that your contributions will be licensed under the [MIT License](LICENSE.md).