# Security Policy

## Supported Versions

We actively support the following versions of this **unofficial A-Cube PHP SDK for PHP**:

| Version | Supported          |
| ------- | ------------------ |
| 0.1.x   | :white_check_mark: |
| < 0.1.0 | :x:                |

## Reporting a Vulnerability

If you discover a security vulnerability in this SDK, please report it responsibly:

1. **Do NOT** open a public GitHub issue
2. Use one of the following methods:
   - Open a [GitHub Security Advisory](https://github.com/fezz02/unofficial-acube-php-sdk/security/advisories/new)
   - Email the maintainer (contact information available on GitHub profile)

Please include:

- Description of the vulnerability
- Steps to reproduce
- Potential impact
- Suggested fix (if you have one)

We will attempt to respond to security reports, but cannot guarantee response time or resolution.

## Security Best Practices

### Credentials and Secrets

**NEVER commit credentials, API keys, tokens, or passwords to the repository.**

- Use environment variables for sensitive data
- Add sensitive files to `.gitignore`
- Use placeholder values in examples and documentation
- Rotate any credentials that may have been exposed

### A-Cube API Security

This SDK is an **independent, unofficial wrapper** around the A-Cube API. Security of the A-Cube infrastructure itself is managed by A-Cube. This SDK:

- Does not store or transmit credentials beyond what is necessary for API authentication
- Uses secure HTTPS connections to A-Cube endpoints
- Implements token caching as a convenience feature (you can disable it)
- Does not control or have access to A-Cube's infrastructure

### Dependencies

We regularly update dependencies to address security vulnerabilities. If you discover a vulnerability in a dependency:

1. Check if an update is available
2. Report it if it affects this SDK
3. Consider using `composer audit` to check for known vulnerabilities

## Scope

This security policy covers:

- Security vulnerabilities in the SDK code itself
- Security issues with dependencies used by the SDK
- Security concerns with how the SDK handles authentication and tokens

This security policy does NOT cover:

- Issues with the A-Cube API itself (contact A-Cube directly)
- General usage questions or feature requests
- Issues that do not have a security impact

## Disclosure Policy

- We will attempt to acknowledge receipt of your vulnerability report
- We will attempt to work with you to understand and resolve the issue
- We will attempt to provide updates on the status of the fix
- We will credit you in the security advisory (if you wish)
- We will attempt to coordinate public disclosure after a fix is available

Thank you for helping keep this unofficial A-Cube PHP SDK secure!
