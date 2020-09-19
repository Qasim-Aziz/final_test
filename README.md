# Hydria
Managed PostgreSQL Databases as a Service

## Continuous Integration & Delivery

GitHub Actions are used for CI/CD. Encrypted secrets that configure each environment [are stored as per documentation](https://docs.github.com/en/actions/reference/encrypted-secrets)

### Development

Pushing to `dev` will cause deployment to the `development` environment of Hydria - assuming all tests pass.

### Production

Pushing to `master` will cause deployment to the `production` environment of Hydria - assuming all tests pass.
