
# PHP JWK 
[![MIT License](https://img.shields.io/badge/License-MIT-green.svg)](https://choosealicense.com/licenses/mit/)

Create JWKs from private keys


## Installation

```bash
  composer require rogerlopez13/php-jwk
```
    
## Usage/Examples
Get an array containing all necessary fields of the JWK using a private key.
```php
$pk = "YOUR SHA-256 PRIVATE KEY";
$jwk = \Rogerlopez13\Jwk\JWK::fromPrivateKey($pk);
```

