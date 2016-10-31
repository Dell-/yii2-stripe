```
Request:

curl https://api.stripe.com/v1/charges \
>    -u sk_test_xxxxxQDxXNiLJuhtuW2BGj7j: \
>    -d amount=2000 \
>    -d currency=usd \
>    -d customer=cus_9TcNqGgggVAUF3

Response:

{
  "id": "ch_19Af9JLOooR23oA9oTNXgb9R",
  "object": "charge",
  "amount": 2000,
  "amount_refunded": 0,
  "application": null,
  "application_fee": null,
  "balance_transaction": "txn_19Af9JLOooR23oA9DpOC5kg1",
  "captured": true,
  "created": 1477917865,
  "currency": "usd",
  "customer": "cus_9TcNqGgggVAUF3",
  "description": null,
  "destination": null,
  "dispute": null,
  "failure_code": null,
  "failure_message": null,
  "fraud_details": {},
  "invoice": null,
  "livemode": false,
  "metadata": {},
  "order": null,
  "outcome": {
    "network_status": "approved_by_network",
    "reason": null,
    "risk_level": "normal",
    "seller_message": "Payment complete.",
    "type": "authorized"
  },
  "paid": true,
  "receipt_email": null,
  "receipt_number": null,
  "refunded": false,
  "refunds": {
    "object": "list",
    "data": [],
    "has_more": false,
    "total_count": 0,
    "url": "/v1/charges/ch_19Af9JLOooR23oA9oTNXgb9R/refunds"
  },
  "review": null,
  "shipping": null,
  "source": {
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
  },
  "source_transfer": null,
  "statement_descriptor": null,
  "status": "succeeded"
}
```