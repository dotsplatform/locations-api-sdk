# Progress — DEV-18668 branch Schema.org markup — locations-api-sdk part

Plan v2 is in use (`plans/DEV-18668-branch-schema-markup.v2.plan.md`). Reason: the
Places key is entered through the SDK `GoogleProvider` entity (livesite admin form),
found during locations exploration.

- [x] 1. Explore
- [x] 2. Entity
- [x] 3. DTO + client method
- [~] 4. Tests — written, not executed (see below)
- [ ] 5. Release prep — **waiting for developer approval**
- [x] 6. Review notes + summary

## Notes

- `LocationsClient` is implemented by stubs in livesite (`tests/StubClients`),
  clients-api (`app/Services/Clients/Stub`) and deliveries (`tests/Stubs`). Adding a
  method there would fatally break those stubs on the next SDK update, so the new
  method lives in a separate interface `LocationsPlacesClient`, implemented by the same
  `LocationsHttpClient`. Consumers bind `LocationsPlacesClient` themselves.
- `tests/App/DTO/Result/PlaceDetailsDTOTest.php` added. The SDK has no `vendor/`
  locally and its `composer.lock` is out of date (`composer install` refuses, `composer
  update` cannot write the lock in the container), so phpunit was not run. Changed files
  pass `php -l`.

## Summary

Code ready. Proposed tag: `v1.13.0` (minor, backward compatible). Not tagged.
