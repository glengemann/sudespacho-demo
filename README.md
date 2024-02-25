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
}' | jq .token
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

- Filter by Name

```bash
curl -X 'GET' \
  'http://127.0.0.1:8000/api/products?page=1&name=Co' \
  -H 'Accept: application/ld+json' \
  | jq
```

## Create Product

```bash
curl -X 'POST' \
  'http://127.0.0.1:8000/api/products' \
  -H 'accept: application/ld+json' \
  -H 'Content-Type: application/ld+json' \
  -H 'Authorization: Bearer 7bf900e102fb4b4226e1a98f35d5df8335804a13a0833377853a47979030826f5a25' \
  -d '{
  "name": "Product 1",
  "description": "Product 1 Description",
  "price": 0,
  "tax": 4
}' | jq
```