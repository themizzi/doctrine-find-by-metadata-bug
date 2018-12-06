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