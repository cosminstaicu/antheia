# Upgrading from Antheia 2.x to 3.0

### Migration

- Update Composer dependencies:

```bash
composer remove antheia/antheia
composer require antheia/framework
```

- Replace namespace imports:

```php
Antheia\Antheia\Classes\
```

with:

```php
Antheia\Framework\
```

- Replace remaining legacy namespace references:

```php
Antheia\Antheia\
```

with:

```php
Antheia\Framework\
```

- In most projects, migration can be completed with a global search-and-replace operation.
