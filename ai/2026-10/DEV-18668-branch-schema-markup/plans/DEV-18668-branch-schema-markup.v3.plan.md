# Plan v3 — DEV-18668 Schema.org Restaurant markup — locations-api-sdk part

- Task identifier: `2026-10-19-DEV-18668-branch-schema-markup`
- Plan version: v3 (written 2026-11-03), supersedes `DEV-18668-branch-schema-markup.v2.plan.md`
- Services in scope: livesite, clients-api, client-web, locations, locations-api-sdk.
  This file covers locations-api-sdk. The cross-service picture is in
  `livesite/ai/2026-10/DEV-18668-branch-schema-markup/plans/DEV-18668-branch-schema-markup.v3.plan.md`.

## 1. Header

### Why v2 is superseded

SEO moved the markup from CMS web pages to the storefront company Info page, with one
`Restaurant` per company address. In clients-api, the SDK's consumer moves from the web page
generator to the new Info-page endpoint. **The SDK contract does not change.** This version
records that, and the remaining release steps.

### Decisions taken from the developer's answers

| # | Answer | Consequence here |
|---|---|---|
| Q3 | Keep Google Places. The SDK tag is still needed, and only with explicit developer approval. | Keep `GoogleProvider::$placeDetailsApiKeys` + `getPlaceDetailsApiKeys()`, `LocationsPlacesClient` (separate interface, so existing `LocationsClient` stubs in livesite, clients-api and deliveries keep compiling), `LocationsHttpClient::placeDetails()`, `PlaceDetailsDTO`. |
| Q1, Q2, Q4, Q5 | — | Not applicable to the SDK. |

## 2. Requirements checklist

| # | Item | Status |
|---|---|---|
| S1 | `placeDetails(accountId, placeId): PlaceDetailsDTO` with `isAvailable()`, `getRating()`, `getUserRatingCount()`, `getGoogleMapsUri()`. | in scope (done) |
| S2 | `placeDetailsApiKeys` on `GoogleProvider` (default `[]`, old rows still deserialize). | in scope (done) |
| S3 | Backward compatible for clients still on `v1.12.x`. | in scope (minor bump, new interface, no changed signatures) |
| S4 | Tag `v1.13.0`. | in scope, **pending explicit approval** |

## 3. Assumptions

- F1. The version is `v1.13.0` (minor), as proposed in v2.

## 4. Architecture

No code change. Consumers after the tag:

- clients-api: `composer.json` `dev-feature-DEV-18668 as 1.12.99` → `^1.13`. It binds `LocationsPlacesClient` → `LocationsHttpClient` in `AppServiceProvider` (already done).
- livesite: constraint `^v1.10.0`, so only `composer.lock` changes.

## 5. Database

None.

## 6. Data flow

clients-api `CompanyRestaurantGoogleDetailsResolver` → `LocationsPlacesClient::placeDetails()` → locations `GET /accounts/{account}/places/{placeId}`.

## 7. Implementation steps

1. **Run the DTO test**, still open from v2 step 4. Install dependencies in a scratch copy, or fix the stale `composer.lock` locally without committing unrelated updates. Then run `vendor/bin/phpunit tests/App/DTO/Result/PlaceDetailsDTOTest.php`. If the lock cannot be fixed without unrelated updates, report that to the developer instead of committing it.
2. **Release prep.** Draft the tag `v1.13.0` and its notes ("place details client + Places API key list"). **Stop and ask the developer for approval** for the merge to master, the tag and the push. These are separate approvals per repo.
3. **Progress and review.** Record that v3 is in use and why, and the tag status.

## 8. Performance notes

None. This is a thin HTTP client.

## 9. Deploy order

The tag comes after locations is deployed and before the clients-api and livesite composer bumps (full order in the livesite v3 plan).

## 10. Out of scope

- Batch place details.
- Changes to `LocationsClient`.

## 11. Risks and open points

- Until the tag exists, clients-api depends on a dev branch (`dev-feature-DEV-18668`). It must not be merged to master or deployed to production in that state.
