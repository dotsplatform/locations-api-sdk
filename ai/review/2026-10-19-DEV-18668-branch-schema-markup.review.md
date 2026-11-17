# Review — DEV-18668 branch Schema.org markup — locations-api-sdk part

## What changed

- `Entities\GoogleProvider::$placeDetailsApiKeys` (+ getter), default `[]`.
- New interface `Client\LocationsPlacesClient::placeDetails(accountId, placeId)`.
- `LocationsHttpClient` implements it: `GET /accounts/{account}/places/{placeId}`;
  any transport error or empty body → `PlaceDetailsDTO::empty()` (`available: false`).
- New `DTO\Results\PlaceDetailsDTO` (`available`, `rating`, `userRatingCount`,
  `googleMapsUri`).

## Breaking changes

None. `LocationsClient` interface is untouched on purpose (stubs in other repos
implement it).

## Release

Proposed tag `v1.13.0`. **Not created — needs explicit approval.**

## Risks

- Unit test written but not executed locally (SDK dev dependencies cannot be installed
  in the container with the current lock file).
