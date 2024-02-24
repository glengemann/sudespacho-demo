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
curl -X 'GET' \
  'http://127.0.0.1:8000/api/products?page=1' \
  -H 'accept: application/ld+json' \
  -H 'Authorization: Bearer d7fbd220dbf164a4de4e4d2a2a1069d083903f427154214807979908fb5b209097a4'
```