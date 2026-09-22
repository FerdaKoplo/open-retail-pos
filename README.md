# Open Source Version of PoS Application

## General Rules

1. All changes to the repository must have a clear purpose.
2. Each contributor is responsible for the changes they make.
3. Do not modify another contributor's work without prior communication.
4. Do not combine unrelated tasks into a single branch.
5. Do not push directly to `main`.
6. Do not force-delete or alter the `main` branch history.
7. All changes merged into `main` must go through a Pull Request.
8. Changes affecting the database, authentication, authorization, payment, inventory, deployment, backup, or recovery must be reviewed before merging.

## 2. Main Branch

`main` is the repository's primary branch.

Rules:

- `main` must always remain in a runnable state.
- Direct pushes to `main` are not allowed.
- Force pushes to `main` are not allowed.
- A Pull Request is required to merge changes into `main`.
- CI must pass before a Pull Request can be merged.
- A Pull Request must be reviewed by another contributor.

## 3. Issues

Features, bugs, structural changes, and sufficiently large technical tasks must have an Issue.

An Issue must at minimum describe:

- the goal of the work;
- the scope of the change;
- the acceptance criteria;
- dependencies, if any.

For Example :

```text
Feature: Product Expiration

Acceptance Criteria:
- Product dapat memiliki beberapa batch.
- Setiap batch dapat memiliki tanggal kadaluarsa.
- Batch yang sudah kadaluarsa tidak dapat digunakan untuk transaksi.
- Stock Keeper dapat mengelola informasi batch.
```

The branch working on an issue must include the issue number.

Example :

```text
feature/24-product-expiry
```

## 4. Branch Naming

Use the following format:

```text
<type>/<issue-number>-<description>
```

Use `kebab-case` for the description.

Allowed branch types:

```text
feature/
fix/
refactor/
docs/
test/
chore/
ci/
perf/
build/
hotfix/
```

Example:

```text
feature/12-product-management
fix/31-stock-calculation
refactor/41-inventory-service
docs/18-installation
test/52-sales-feature
chore/60-update-dependencies
ci/65-github-actions
perf/71-product-search
hotfix/80-payment-transaction
```

A branch must be used for one primary task only.

## 5. Commit Messages

Use the Conventional Commits format:

```text
<type>: <description>
```

Or:

```text
<type>(<scope>): <description>
```

Commit messages must be written in English.

Example :

```text
feat: add product management
feat(inventory): add stock movement ledger
fix(pos): prevent duplicate checkout submission
refactor(inventory): extract stock calculation service
docs: add cPanel deployment guide
test(sales): add refund transaction tests
chore: update project dependencies
ci: add pull request checks
perf(products): optimize barcode lookup
```

A commit must describe the change it makes.

Avoid commit messages such as:

```text
update
fix
final
final fix
test
asdf
```

One commit should represent one logical change.

## 6. Commit Scope

The scope is optional and should be used when it helps identify the affected area.

Common scopes:

```text
auth
users
products
inventory
pos
sales
payment
purchasing
reports
hardware
deployment
database
ui
```

Contoh:

```text
feat(products): add barcode management
fix(payment): validate payment amount
test(inventory): cover stock adjustment
```

## 7. Pull Requests

Every change intended for `main` must be submitted as a Pull Request.

Judul Pull Request mengikuti format commit:

```text
feat(inventory): add product batch expiry
```

A Pull Request must contain:

```text
## Summary

Jelaskan perubahan yang dibuat.

## Changes

- Perubahan 1
- Perubahan 2
- Perubahan 3

## Testing

Jelaskan test yang dijalankan.

## Related Issue

Closes #24
```

A Pull Request must have a clear scope.

Do not include unrelated changes in the same Pull Request.

## 8. Code Review

A contributor other than the author must review the changes before merge.

The review must check:

- kesesuaian dengan requirement;
- correctness;
- business logic;
- keamanan;
- integritas data;
- database migration;
- test;
- maintainability;
- kemungkinan regression.

Special attention must be given to:

- stock calculation;
- transaction consistency;
- payment;
- refund;
- void;
- authorization;
- duplicate transaction;
- database concurrency.

Review comments must explain the problem and why a change is required.

## 9. Merge

Use **Squash and Merge** for Pull Requests.

Branch:

```text
feature/24-product-expiry
```

can have multiple commits during the development process:

```text
test
fix migration
fix validation
update controller
fix test
```

After merging, `main` should contain one commit representing that work:

```text
feat(inventory): add product batch expiry
```

A Pull Request must not be merged when:

- CI failed;
- there are unresolved review comments;
- requirements have not been met;
- there are database changes without corresponding migrations;
- secrets or credentials have been committed.

## 10. Updating a Branch

Before a Pull Request is merged, the branch must be updated with the latest changes from `main`.

Contoh:

```bash
git fetch origin
git rebase origin/main
```

After rebasing, run the tests again before pushing.

For branches already shared with another contributor, do not rewrite history without communicating first.

If rebasing changes the history of a personal branch, use:

```bash
git push --force-with-lease
```

Do not use:

```bash
git push --force
```

## 11. Definition of Done

A task is considered complete when:

- requirements have been met;
- code has been tested;
- relevant tests passed;
- no known lint or type-checking errors;
- migration provided if the schema changed;
- documentation updated if necessary;
- Pull Request has been reviewed;
- CI passed;
- all review comments have been resolved;
- changes have been merged into `main`.

## 12. Database Rules

All schema changes must be made through migrations and stored in the repository.

Use:

```text
database/migrations/
```

Do not rely on manual database changes that are not recorded in the repository.

Every migration must be runnable on a new environment.

Schema changes must be tested before being merged.

Changes related to inventory must preserve consistency between:

```text
inventory_stocks
batch_stocks
stock_movements
```

Changes involving transactions, payments, refunds, and stock must use appropriate transaction boundaries.

## 13. Environment and Secrets

Do not commit:

```text
.env
API keys
database passwords
payment credentials
private keys
production secrets
```

Use:

```text
.env.example
```

to document the required environment variables.

Example:

```text
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

XENDIT_SECRET_KEY=
```

The `.env.example` file must not contain real credentials.

## 14. Testing

Every change that affects behavior must have appropriate tests.

Tests must at minimum cover:

- business logic utama;
- authorization;
- validation;
- database behavior;
- error case yang relevan.

Changes to inventory and payment must include tests for both successful and failed cases.

## 15. Documentation

Documentation must be updated when changes affect:

- installation;
- deployment;
- configuration;
- database;
- API;
- hardware integration;
- backup;
- recovery;
- development workflow.

Outdated documentation must be corrected in the same Pull Request when the change makes it incorrect.

## 16. Hotfix

Bugs that directly affect production use may be handled through a branch:

```text
hotfix/<issue-number>-<description>
```

Contoh:

```text
hotfix/80-payment-transaction
```

A hotfix must still:

1. created from `main`;
2. has tests;
3. created as a Pull Request;
4. reviewed;
5. passes CI;
6. merged into `main`.

## 17. Standard Commands

Create branch:

```bash
git switch main
git pull origin main
git switch -c feature/24-product-expiry
```

Commit:

```bash
git add .
git commit -m "feat(inventory): add product batch expiry"
```

Push:

```bash
git push -u origin feature/24-product-expiry
```

Update branch:

```bash
git fetch origin
git rebase origin/main
```
