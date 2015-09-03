UPS Shipping API Bundle
=======================

This bundle provides Shipping service to create shipments via UPS /ShipConfirm and /ShipAccept API endpoints using
[UPS API library](https://github.com/gabrielbull/php-ups-api).

Installation
------------

Add `eduard-sukharev/ups-shipment-bundle` to `require` section of your `composer.json`, e.g.:

```
    "require": {
        ...
        "eduard-sukharev/ups-shipment-bundle": "~0.1",
        ...
    }
```

Add following parameters to your `app/config.yml`:

```yml
opensoft_ups_shipment:
    credentials:
        ups_production_mode: true # true for production server, false for testing/integration server
        ups_access_key: YourUpsAccessKeyHere
        ups_username: UpsUserName
        ups_password: UpSpAsSwOrD
```

**Note:** When creating Shipment object, at some point you will also need to set ShipperNumber parameter, which can be
found on [UPS site](www.ups.com): Log in, navigate to *My UPS* -> *Account Summary*, see section **UPS Account Details** for a
6-character string in **Number** column of desired UPS account.
