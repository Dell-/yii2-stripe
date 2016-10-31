```
Request:

curl https://api.stripe.com/v1/customers \
>    -u sk_test_xxxxxQDxXNiLJuhtuW2BGj7j: \
>    -d source=tok_19Af8BLOooR23oA9RwBDn4YL \
>    -d description="Joshua Wilson" \
>    -d email="joshua.wilson.34@example.com"

Response:
{
  "id": "cus_9TcNqGgggVAUF3",
  "object": "customer",
  "account_balance": 0,
  "created": 1477917832,
  "currency": null,
  "default_source": "card_19Af8BLOooR23oA9owF3x9iK",
  "delinquent": false,
  "description": "Joshua Wilson",
  "discount": null,
  "email": "joshua.wilson.34@example.com",
  "livemode": false,
  "metadata": {},
  "shipping": null,
  "sources": {
    "object": "list",
    "data": [
      {
        "id": "card_19Af8BLOooR23oA9owF3x9iK",
        "object": "card",
        "address_city": null,
        "address_country": null,
        "address_line1": null,
        "address_line1_check": null,
        "address_line2": null,
        "address_state": null,
        "address_zip": null,
        "address_zip_check": null,
        "brand": "Visa",
        "country": "US",
        "customer": "cus_9TcNqGgggVAUF3",
        "cvc_check": "pass",
        "dynamic_last4": null,
        "exp_month": 12,
        "exp_year": 2017,
        "fingerprint": "iTHbYN5GP9peHPW4",
        "funding": "credit",
        "last4": "4242",
        "metadata": {},
        "name": null,
        "tokenization_method": null
      }
    ],
    "has_more": false,
    "total_count": 1,
    "url": "/v1/customers/cus_9TcNqGgggVAUF3/sources"
  },
  "subscriptions": {
    "object": "list",
    "data": [],
    "has_more": false,
    "total_count": 0,
    "url": "/v1/customers/cus_9TcNqGgggVAUF3/subscriptions"
  }
}
```