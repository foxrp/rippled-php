Development
===========

By `Development`, we mean development of this project, not ones that use the library.

## API Method and Transaction Type Generator

Adding fields to Methods and Transaction Types is some pretty repetitive business. It becomes even
more repetitive if we're trying to keep documentation in sync with the actual codebase.

A decision was made to manage the `rippled` spec in JSON files, then programmatically implement the repetitive
aspects with a CLI application to avoid the overhead in reading JSON realtime each time a class is called.

The rippled API spec is defined in a JSON format in the [`rippled-spec`](../rippled-spec) directory.

## Add/update API Methods

The following command will:

- Add/update common fields to `src/Api/Method/AbstractMethod`
- Add Method classes if they don't exist
- Update fields for each Method class

```
bin/generate.php api
```

Note: Advanced validations are manually added to each class. They will not be overwritten when generating updates.


## Add/Update Transaction Types

The following command will:

- Add/update common fields to `src/Transaction/Type/AbstractType`
- Add Type classes if they don't exist
- Update fields for each Type class

```
bin/generate.php types
```

Note: Advanced validations are manually added to each class. They will not be overwritten when generating updates.
