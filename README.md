# Pizza Order POS

POS module with dynamic pizza order status updates using **Laravel 12**, **Vue 3**, and **Reverb** for real-time broadcasting.

---

## Getting Started

1. Install PHP dependencies:
    ```bash
    composer install
    ```

2. Install JavaScript dependencies:
    ```bash
    npm install
    ```

3. Build assets:
    ```bash
    npm run dev
    ```

4. Configure environment:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
   Add and set these variables in `.env`:
    
   ```bash
   BROADCAST_CONNECTION=reverb
   BROADCAST_DRIVER=reverb
   REVERB_APP_ID=<app-id>
   REVERB_APP_KEY=<app-key>
   REVERB_APP_SECRET=<app-secret>
   REVERB_HOST=127.0.0.1
   REVERB_PORT=8080
   ```

5. Start Laravel server:
   ```bash
   php artisan serve
   ```

6. Start Reverb server:
   ```bash
   php artisan reverb:start
   ```
7. Start queue worker:
   ```bash
   php artisan queue:work
   ```

---

## API Overview

### Update Order Status

**POST** `/api/order-status-update`

Broadcasts a new order status in real-time.

**Body Parameters:**

| Parameter | Required | Type    | Valid values             |
|-----------|----------|---------|--------------------------|
| id        | ✓        | integer | 1, 2, 3                  |
| status    | ✓        | string  | Ready, Cooking, Pending  |

**Payload Example:**

```json
{
    "id": 3,
    "status": "Ready"
}
