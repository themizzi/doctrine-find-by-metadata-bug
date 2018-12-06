- Basic Entity Persister correctly finds base inherited entity EntityA.
- Loads that metadata, does its thing fine.
- Basic Entity Persister now tries to set the correct value in the SQL params.
- On a second request (when cache has already been loaded), metadata for EntityC is missing.
- Basic Entity Persister only ever asks: `$this->em->getMetadataFactory()->hasMetadataFor(ClassUtils::getClass($value))` on lines 1958 and 1983. Because this has never been loaded since all the work so far has been on EntityA (the parent), the find by doesn't cast its value to the integer id, and the request to the DB fails because the value passed to PDO is the entire entity class. In SQLITE, this simply fails. In MySQL this is worse because it goes and finds the entity with ID value of 1 which poses integrity and security issues.

To reproduce the issue run:

```bash
bin/console doctrine:schema:update --force
bin/console create:entity-a
bin/console create:entity-b 1
bin/console find:entity-b-by-new-entity-c
```

Of more interest, this works on the first, but not subsequent tries if cache is cleared because the initial request loads ALL class metadata.

Starting clean:
```bash
bin/console doctrine:schema:update --force
bin/console create:entity-a
bin/console create:entity-b 1
rm -rf var/cache/*
bin/console find:entity-b-by-new-entity-c // works
bin/console find:entity-b-by-new-entity-c // fails
```
