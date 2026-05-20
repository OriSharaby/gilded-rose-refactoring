# Gilded Rose Refactoring Kata (PHP)

## Overview

This repository contains my solution for the Gilded Rose Refactoring Kata in PHP.

The goal of this exercise was to safely refactor legacy code while preserving the existing business behavior using automated tests.

After completing the refactoring phase, support for the new `Conjured` item type was implemented.

---

## Installation

### Requirements

- PHP 8.0+
- Composer

### Clone the repository

```bash
git clone https://github.com/OriSharaby/gilded-rose-refactoring.git
```

### Install dependencies

```bash
composer install
```

---

## Dependencies

The project uses:

- PHPUnit
- ApprovalTests.PHP
- PHPStan
- Easy Coding Standard (ECS)

---

## Refactoring Approach

Before modifying the legacy code, I first added characterization tests in order to preserve the existing behavior and create a safety net for the refactoring process.

The refactoring was done gradually in small, incremental steps while continuously running the test suite.

The improvements included:

- Extracting helper methods
- Removing duplicated logic
- Reducing nested conditionals
- Improving naming
- Replacing magic strings with constants
- Separating item-specific business logic
- Lowering overall complexity
- Improving readability and maintainability

Examples of extracted methods:

- `increaseQuality()`
- `decreaseQuality()`
- `decreaseSellIn()`
- `updateBackstagePass()`
- `updateExpiredItem()`
- `updateConjured()`

The refactoring phase was completed before implementing any new functionality.

---

## Conjured Items

Support was added for:

```text
Conjured Mana Cake
```

Business rules:

- Conjured items decrease in quality twice as fast as normal items
- After the sell date has passed, quality decreases by 4 per day

The new feature was implemented only after the refactoring phase was completed and fully covered by tests.

---

## Testing

The project includes:

- Characterization tests
- Unit tests
- Approval tests

The tests cover the main business rules for:

- Normal items
- Aged Brie
- Sulfuras
- Backstage passes
- Conjured items

All tests are currently passing.

### Run all tests

```bash
composer tests
```

### Run PHPUnit directly

```bash
vendor/bin/phpunit tests/GildedRoseTest.php
```

### Run fixture

```bash
php .\fixtures\texttest_fixture.php 10
```

---

## Code Standards & Static Analysis

### Run ECS checks

```bash
composer check-cs
```

### Fix coding style automatically

```bash
composer fix-cs
```

### Run PHPStan

```bash
composer phpstan
```

---

## Git Workflow

Development was done using multiple branches:

- `refactor/gilded-rose`
- `feature/add-conjured-support`

Changes were merged into `main` only after all tests passed successfully.

The commit history reflects the incremental refactoring process and feature implementation.

---

## Possible Future Improvements

Possible future improvements could include replacing conditional item handling with a Strategy Pattern or dedicated updater classes per item type.