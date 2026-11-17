# Plan — DEV-18668 branch Schema.org markup — locations-api-sdk part

Cross-service order of work: locations → locations-api-sdk → livesite → clients-api → client-web.
This repo is step 2 of the overall sequence.

## Steps

1. **Explore**: client structure, existing method/DTO conventions, tests.
2. **DTO + client method** matching the locations endpoint contract.
3. **Tests** (if the SDK has them) — targeted run.
4. **Release prep**: draft tag name (`v1.13.0`), stop and ask for approval.
5. **Review notes + progress summary**.
