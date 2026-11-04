# Batch distance results — accept null items (locations-api-sdk)

Branch: `fix-batch-null-items`

## Why

`locations` answers `POST /accounts/{id}/batch-distance-data` with `null` for an item it could not resolve
(`BatchMultiTransportDistanceDataResolver::resolve()` catches the provider error and stores `null` for that key).
`BatchDistanceResults::fromArray()` passed that `null` into `DistanceResults::fromArray(array)` and threw a
`TypeError`, so one failed route threw away the whole batch. In livesite the batch resolver then fell back to one
single `distance-data` call per item (1.5–2 s each on a miss).

## What changed

- `src/App/DTO/Results/BatchDistanceResults.php`
  - `fromArray()` skips items that are not arrays (`null` for a failed route); such keys are "missing":
    `getItemByKey()` returns `null` for them.
  - New `hasItemByKey(string $key): bool` and `getMissingKeys(string[] $requestedKeys): string[]`, so a consumer can
    retry only the items the batch did not resolve.
- `tests/App/DTO/Result/BatchDistanceResultsTest.php` — null item skipped, missing keys reported.

## Release

Tag a minor version (`v1.13.0`). livesite requires `^v1.10.0`, so only `composer.lock` changes there
(`composer update dotsplatform/locations-api-sdk`). livesite's branch `perf-merge-locations-calls` works with the old
and the new version (it guards the new behaviour by catching the old `TypeError`).

## Database / performance

No database access, no schema changes. Fewer outbound calls in consumers on partial batch failures.

## Risk

Low. Before, a batch with a `null` item always threw; now it returns the resolved items. Consumers that iterate the
collection see fewer items than they requested — `getItemByKey()` already returned `?DistanceResults`.
