# YOURLS Batch Shortener API

A simple YOURLS plugin that adds a **batch URL shortening endpoint**.  
You can send multiple URLs in a single API request and receive all shortened results in one JSON response.  

---

## 🚀 Features

- Shorten multiple URLs in one API call  
- Returns structured JSON with each item’s `id`, `url`, `shorturl`, and `status`  
- Works seamlessly with Postman or any HTTP client  
- Lightweight and dependency-free  

---

## 📦 Installation

1. Download or clone this repository into your YOURLS plugin directory: **yourls/user/plugins/**

2. Activate the plugin in your YOURLS admin panel:  
**Admin → Manage Plugins → Activate "Batch Shortener API"**

3. The new endpoint will be available at: **http://yourdomain.com/yourls/yourls-api.php?signature=your_signature&action=batch_shortener&format=json**

---

## 🧩 API Usage

### Request
**Method:** `POST`  
**URL:** `http://yourdomain.com/yourls/yourls-api.php?signature=your_signature&action=batch_shortener&format=json`  
**Headers:** `Content-Type: application/json`

**Body:**
```json
{
    "urls": [
        {
            "id": 1,
            "url": "https://example.com/5"
        },
        {
            "id": 2,
            "url": "https://example.com/6"
        }
    ]
}
```
**Response:**
```json
{
    "results": [
        {
            "id": 1,
            "url": "https://example.com/5",
            "shorturl": "yourdomain.com/yourls/6",
            "status": "success"
        },
        {
            "id": 2,
            "url": "https://example.com/6",
            "shorturl": "yourdomain.com/yourls/7",
            "status": "success"
        }
    ]
}
```

---

## 🧠 Example Usage

### 🐍 Python Example (using requests)
```python
import requests
import json

url = "http://localhost:8081/yourls/?batch_api"
payload = {
    "urls": [
        {"id": 1, "url": "https://example.com/5"},
        {"id": 2, "url": "https://example.com/6"}
    ]
}
headers = {"Content-Type": "application/json"}

response = requests.post(url, headers=headers, data=json.dumps(payload))
print(response.json())
```

### 🐘 PHP Example (using cURL)

```php
<?php
$endpoint = "http://localhost:8081/yourls/?batch_api";

$data = [
    "urls" => [
        ["id" => 1, "url" => "https://example.com/5"],
        ["id" => 2, "url" => "https://example.com/6"]
    ]
];

$ch = curl_init($endpoint);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json'
]);

$response = curl_exec($ch);
curl_close($ch);

echo $response;
```

### 💻 C# Example (using HttpClient)

```csharp
using System;
using System.Net.Http;
using System.Text;
using System.Threading.Tasks;

class Program
{
    static async Task Main()
    {
        var client = new HttpClient();
        var url = "http://localhost:8081/yourls/?batch_api";

        var json = @"{
            ""urls"": [
                { ""id"": 1, ""url"": ""https://example.com/5"" },
                { ""id"": 2, ""url"": ""https://example.com/6"" }
            ]
        }";

        var content = new StringContent(json, Encoding.UTF8, "application/json");
        var response = await client.PostAsync(url, content);
        var result = await response.Content.ReadAsStringAsync();

        Console.WriteLine(result);
    }
}
```

---

## ⚙️ Example with curl

```bash
curl -X POST "http://localhost:8081/yourls/?batch_api" \
  -H "Content-Type: application/json" \
  -d '{
    "urls": [
      {"id": 1, "url": "https://example.com/5"},
      {"id": 2, "url": "https://example.com/6"}
    ]
  }'
```

## 🪪 License

This project is licensed under the [MIT License](LICENSE).  
Feel free to use, modify, and distribute it with proper attribution.

---

## 👨‍💻 Author

**Saeid Feyziniya**  
[GitHub Profile](https://github.com/saeidfeyziniya)
