# Plan v2 — DEV-18668 branch Schema.org markup — locations-api-sdk part

Reason for v2: the Places API key is entered via livesite → SDK `GoogleProvider` →
locations, so the SDK entity needs the new key list too (found in locations step 2).

## Steps

1. **Explore**: client structure, existing method/DTO conventions, tests, implementers
   of `LocationsClient` in other repos.
2. **Entity**: `GoogleProvider::$placeDetailsApiKeys` (default `[]`) + getter.
3. **DTO + client method**: `PlaceDetailsDTO`; `placeDetails(accountId, placeId)` in
   `LocationsHttpClient` (`GET /accounts/{account}/places/{placeId}`), declared in a new
   `LocationsPlacesClient` interface so existing `LocationsClient` implementers
   (stubs in livesite, clients-api, deliveries) do not break.
4. **Tests** — DTO test; targeted run.
5. **Release prep**: draft tag name (`v1.13.0`), stop and ask for approval.
6. **Review notes + progress summary**.
