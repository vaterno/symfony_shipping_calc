## Installation
1. **Just run**
```bash
make setup
```

2. **Stop the container**
```bash
make down
```

## Links
- Frontend: http://localhost:5173
- Backend: http://localhost:8080

## Endpoints

### 1. Carries
#### GET `http://localhost:8080/api/shipping/carriers`

**Response:**
```json
[
    {
      "name": "Packgroup",
      "slug": "packgroup"
    },
    {
      "name": "Transcompany",
      "slug": "transcompany"
    }
]
```

### 2. Calculate
#### POST `http://localhost:8080/api/shipping/calculate`

**Request:**
```json
{
  "carrier": "transcompany",
  "weightKg": 12.5
}
```

**Response:**
```json
{
  "weightKg": 12.5,
  "price": 100,
  "currency": "EUR",
  "carrier": "transcompany"
}
```