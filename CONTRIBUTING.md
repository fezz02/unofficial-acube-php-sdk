# CONTRIBUTING

Contributions are welcome and accepted via pull requests. This is an **unofficial, intentionally scoped** SDK for the A-Cube **Common** and **Italy** APIs only.
Please review these guidelines before submitting any pull requests.

## Scope of This SDK

This SDK is **limited by design**. It only supports:

- A-Cube **Common Management API**
- A-Cube **Italy e-invoicing API**

The following are **explicitly out of scope** and must **not** be implemented without prior discussion and approval:

- Belgium-related APIs
- Poland-related APIs
- PEPPOL integrations
- Open Banking
- Stripe or other payment providers
- Any other country or service not explicitly listed above

If you want to propose support for one of these areas:

1. Open a GitHub issue first.
2. Describe the use case and API surface.
3. Propose a design that fits the existing architecture.
4. Wait for explicit approval before starting implementation.

## Process

1. Fork the project.
2. Create a new branch.
3. Code, test, commit, and push.
4. Open a pull request detailing your changes and what you tested.

## Guidelines

- **Respect the scope**: Only Common + Italy APIs are in scope unless an issue and design have been discussed and approved.
- **Follow the architecture**: Reuse existing patterns for connectors, resources, requests, and DTOs.
- **Coding style**: Run `composer lint` and ensure your code passes.
- **History**: Send a coherent commit history; each commit should be meaningful.
- **SemVer**: We follow [SemVer](http://semver.org/). Do not introduce breaking changes without discussion and clear documentation.
- **Types**: Add type hints for all parameters and return types.
- **Tests are mandatory**:
  - New and changed code must maintain 100% test coverage.
  - Include unit tests and, where possible, feature/integration tests.
  - Make mocking explicit and realistic (match real A-Cube responses and error cases).

## Quality and Production Readiness

We do **not** merge code that “should work”. Code must:

- Be complete (no half-implemented features or large TODOs).
- Be exercised by tests (unit + feature where applicable).
- Be reasoned about with edge cases in mind (validation, error responses, timeouts, etc.).
- Avoid breaking backward compatibility unless:
  - The change is discussed and approved.
  - The impact is documented in the changelog and PR description.

If integration testing against the real A-Cube sandbox or production is **not** possible, document clearly:

- What you tested (which methods, which scenarios).
- What was mocked and why.
- Any assumptions or limitations that remain.

## Setup

Clone your fork, then install the dev dependencies:

```bash
composer install
```

## Lint

Lint your code:

```bash
composer lint
```

## Tests

Run the full test suite (linting, static analysis, typos, type coverage, unit/feature tests):

```bash
composer test
```

Run individual test stages when iterating:

```bash
composer test:unit
composer test:types
composer test:type-coverage
composer test:typos
```
