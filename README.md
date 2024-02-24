## Symfony API Demo

## Login

```bash
curl -X 'POST' \
  'http://127.0.0.1:8000/login' \
  -H 'accept: application/ld+json' \
  -H 'Content-Type: application/ld+json' \
  -d '{
  "email": "admin@demo.com",
  "password": "password"
}' | jq
```

## Logout

```bash
curl -X 'POST' \
  'http://127.0.0.1:8000/logout' \
  -H 'accept: application/ld+json' \
  -H 'Content-Type: application/ld+json' \
  -H 'Authorization: Bearer 592abdf0dc132fd3c486539f5b37901023c947ce228d267bedeb72ed6097457c72ae' \
  | jq
```

## Get Products

```bash
curl -X 'GET' -i \
  'http://127.0.0.1:8000/api/products?page=1' \
  -H 'accept: application/ld+json'
```

## Create Product

```bash
curl -X 'POST' \
  'http://127.0.0.1:8000/api/products' \
  -H 'accept: application/ld+json' \
  -H 'Content-Type: application/ld+json' \
  -H 'Authorization: Bearer ca69449460840b83870d0b79826eed69b2550523c62f355b78c55eb29c8c1b8cd193' \
  -d '{
  "name": "string",
  "description": "string",
  "price": 0,
  "tax": 4
}' | jq
```