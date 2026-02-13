## Installation
1. **Just run**
```bash
make setup
```

## Links
- Frontend: http://localhost:5173
- Backend: http://localhost:8080

## Endpoints

### 1. Carries
#### GET `http://localhost:8080/api/shipping/carriers`

**Response:**
```json
{
  "list": [
    {
      "id": 1,
      "name": "Packgroup",
      "slug": "packgroup",
      "active": true
    },
    {
      "id": 2,
      "name": "Transcompany",
      "slug": "transcompany",
      "active": true
    }
  ]
}
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