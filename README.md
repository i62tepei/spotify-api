# 🎧 Spotify API – Prueba técnica (Laravel 12)

Esta API REST en Laravel permite consultar información de artistas desde Spotify. Incluye documentación con Scramble y autenticación básica para securizar el acceso.

---

## 🛠 Requisitos

- PHP 8.2 o superior  
- Composer  
- Laravel 12  
- Cuenta de desarrollador de Spotify (para obtener `client_id` y `client_secret`)  
- Laravel Valet, Laragon o servidor local configurado  

---

## 🚀 Instalación

### 1. Clonar el repositorio

```bash
git clone https://github.com/i62tepei/spotify-api.git
cd spotify-api
```

### 2. Instalar dependencias

```bash
composer install
```

### 3. Crear y configurar archivo `.env`

```bash
cp .env.example .env
php artisan key:generate
```

Abre el archivo `.env` y añade tus claves de la API de Spotify (creadas en [Spotify Developer Dashboard](https://developer.spotify.com/dashboard)):

```env
SPOTIFY_CLIENT_ID=tu_client_id
SPOTIFY_CLIENT_SECRET=tu_client_secret

API_USER=user
API_PASS=password
```

---

## 🧪 Endpoints

### Obtener artista por ID

```http
GET /api/spotify/get/{id}
```

Ejemplo:
```bash
curl -u user:password http://spotify-api.test/api/spotify/get/1Xyo4u8uXC1ZmMpatF05PJ
```

### Buscar artista por nombre

```http
GET /api/spotify/search/{name}
```

Ejemplo:
```bash
curl -u user:password http://spotify-api.test/api/spotify/search/shakira
```

---

## 🔐 Autenticación

La API está protegida por autenticación **HTTP Basic**. Usa las credenciales definidas en tu `.env`:

```env
API_USER=user
API_PASS=password
```

---

## ✅ Funcionalidades implementadas

- [x] Laravel 12  
- [x] API RESTful  
- [x] Documentación con Scramble  
- [x] Autenticación básica  
- [x] Endpoints: buscar y obtener artistas  

---

## 📌 Notas finales

Este proyecto ha sido desarrollado como parte de una **prueba técnica**.  
