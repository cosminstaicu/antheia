# Upgrading from Antheia 2.x to 3.0

## Composer package rename

```bash
composer remove antheia/antheia
composer require antheia/framework
```

## Namespace migration

Replace:

```php
Antheia\Antheia\
```

with:

```php
Antheia\Framework\
```

In most cases, this can be completed using a global search-and-replace operation.
