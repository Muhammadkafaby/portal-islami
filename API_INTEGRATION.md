# 🌐 API INTEGRATION GUIDE - Portal Islami

Dokumentasi lengkap tentang integrasi API eksternal yang digunakan di Portal Islami.

---

## 📋 DAFTAR API YANG DIGUNAKAN

Portal Islami menggunakan **5 API eksternal** untuk konten Islami. Tidak ada data Quran, Hadits, atau Doa yang disimpan di database lokal.

### 1. **QURAN API** - api.quran.com
**Base URL:** `https://api.quran.com/api/v4`

**Endpoints:**
```
GET /chapters                    - List 114 surah
GET /chapters/{id}               - Detail surah
GET /verses/by_chapter/{id}      - Ayat per surah
GET /verses/by_key/{surah}:{ayat} - Ayat spesifik
```

**Features:**
- 114 Surah lengkap
- 6,236 Ayat Al-Quran
- Terjemahan Indonesia (ID: 134)
- Teks Arab (Uthmani)
- Audio recitation (optional)

**Usage dalam aplikasi:**
- Al-Quran reader
- Quiz Al-Quran (random verses)

---

### 2. **DOA API** - doa-doa-api
**Base URL:** `https://doa-doa-api-ahmadramadhan.fly.dev/api`

**Endpoints:**
```
GET /           - List semua doa
GET /{id}       - Detail doa by ID
```

**Features:**
- 50+ Doa harian
- Teks Arab
- Transliterasi latin
- Terjemahan Indonesia

**Usage dalam aplikasi:**
- Doa & Dzikir collection
- Daily doa recommendations

---

### 3. **PRAYER TIMES API** - Aladhan
**Base URL:** `https://api.aladhan.com/v1`

**Endpoints:**
```
GET /timingsByCity              - Jadwal by kota
GET /timings                    - Jadwal by koordinat
GET /gToH                       - Konversi Gregorian ke Hijri
GET /calendarByCity/{year}/{month} - Kalender bulanan
```

**Parameters:**
- `city`: Nama kota
- `country`: Nama negara
- `method`: Calculation method (2 = ISNA)
- `latitude`, `longitude`: Koordinat

**Features:**
- Waktu shalat 5 waktu
- Kalender Hijriyah
- Multiple calculation methods
- Location-based

**Usage dalam aplikasi:**
- Jadwal shalat harian
- Kalender Hijriyah
- Prayer notifications (future)

---

### 4. **HADITH API** - api.hadith.gading.dev
**Base URL:** `https://api.hadith.gading.dev`

**Endpoints:**
```
GET /books                    - List kitab hadits
GET /books/{id}               - Hadits per kitab
GET /books/{id}/{number}      - Hadits spesifik
```

**Available Books:**
- bukhari (Shahih Bukhari)
- muslim (Shahih Muslim)
- tirmidzi (Jami' Tirmidzi)
- abu-dawud (Sunan Abu Dawud)
- nasai (Sunan An-Nasa'i)
- ibnu-majah (Sunan Ibnu Majah)

**Features:**
- 1000+ hadits shahih
- Teks Arab
- Terjemahan Indonesia
- Multiple books

**Usage dalam aplikasi:**
- Hadits collection
- Daily hadits
- Search by book

---

### 5. **STORY API** - Custom/Mock
**Implementation:** `app/Libraries/StoryApiService.php`

**Features:**
- Kisah Para Nabi
- Kisah Sahabat
- Hardcoded data (dapat diganti dengan API real)

**Data Tersedia:**
- 6 kisah default
- Kategori: Nabi, Sahabat
- Full text content
- Hikmah & pelajaran

**Usage dalam aplikasi:**
- Islamic stories
- Daily inspiration

---

## 🛠️ IMPLEMENTASI DALAM KODE

### Struktur Service Layer

```
app/Libraries/
├── QuranApiService.php      - Quran API integration
├── DoaApiService.php         - Doa API integration
├── PrayerApiService.php      - Prayer times API
├── HadithApiService.php      - Hadith API integration
└── StoryApiService.php       - Stories (mock)
```

### Cara Menggunakan Service

**Contoh 1: Menggunakan Quran API**
```php
use App\Libraries\QuranApiService;

$quranApi = new QuranApiService();

// Get list surah
$surahs = $quranApi->getSurahList();

// Get specific surah with verses
$surahData = $quranApi->getSurah(1); // Al-Fatihah

// Get random verse for quiz
$randomVerse = $quranApi->getRandomVerse();
```

**Contoh 2: Prayer Times**
```php
use App\Libraries\PrayerApiService;

$prayerApi = new PrayerApiService();

// Get today's prayer times
$times = $prayerApi->getTodayPrayerTimes('Jakarta', 'Indonesia');

// Get Hijri date
$hijri = $prayerApi->getTodayHijriDate();

// By coordinates
$times = $prayerApi->getPrayerTimesByCoordinates(-6.2088, 106.8456);
```

**Contoh 3: Hadith**
```php
use App\Libraries\HadithApiService;

$hadithApi = new HadithApiService();

// Get books list
$books = $hadithApi->getBooks();

// Get hadith from specific book
$hadithList = $hadithApi->getHadithList('bukhari', 1);

// Get specific hadith
$hadith = $hadithApi->getHadithDetail('bukhari', 1);
```

---

## 🔧 ERROR HANDLING

Semua API service sudah dilengkapi dengan error handling:

### Try-Catch Blocks
```php
try {
    $response = $this->client->get('/endpoint');

    if ($response->getStatusCode() === 200) {
        $data = json_decode($response->getBody(), true);
        return $data['key'] ?? [];
    }

    return [];
} catch (\Exception $e) {
    log_message('error', 'API Error: ' . $e->getMessage());
    return [];
}
```

### BaseController Helper Methods
```php
// Handle API errors
$this->handleApiError('QuranAPI', $error, 'Gagal mengambil data Quran');

// Validate response
if ($this->isValidApiResponse($data)) {
    // Process data
}

// Format response
return $this->formatApiResponse($data, 'Data berhasil diambil');
```

### Error Logging
- Semua error di-log ke `writable/logs/`
- Format: `[date] ERROR: API Error in Service: message`
- Untuk debugging dan monitoring

---

## 📊 API RATE LIMITS & BEST PRACTICES

### 1. **Quran API (api.quran.com)**
- ✅ No rate limit documented
- ✅ Free to use
- ✅ Stable and fast
- 💡 Cache responses untuk improve performance

### 2. **Doa API**
- ✅ No rate limit
- ✅ Open source
- 💡 Consider local caching

### 3. **Prayer Times API (Aladhan)**
- ⚠️ Rate limit: ~1000 req/day (free tier)
- ✅ Very reliable
- 💡 Cache daily prayer times (update once daily)

### 4. **Hadith API**
- ✅ No strict rate limit
- ✅ Open source
- 💡 Paginate results

---

## 🚀 OPTIMIZATION TIPS

### 1. **Caching Strategy**
```php
// Cache Quran surah list (rarely changes)
$cache = \Config\Services::cache();
$surahs = $cache->remember('quran_surahs', 86400, function() {
    return $quranApi->getSurahList();
});
```

### 2. **Timeout Configuration**
```php
$client = Services::curlrequest([
    'baseURI' => $baseUrl,
    'timeout' => 10, // 10 seconds
]);
```

### 3. **Error Fallback**
```php
$data = $quranApi->getSurahList();
if (empty($data)) {
    // Show cached data or error message
    $data = $cache->get('quran_surahs_backup') ?? [];
}
```

---

## 🧪 TESTING API

### Test Manual dengan cURL

**Test Quran API:**
```bash
curl https://api.quran.com/api/v4/chapters
```

**Test Prayer Times:**
```bash
curl "https://api.aladhan.com/v1/timingsByCity?city=Jakarta&country=Indonesia"
```

**Test Hadith API:**
```bash
curl https://api.hadith.gading.dev/books
```

### Test dalam Aplikasi
1. Buka browser
2. Navigate ke masing-masing halaman:
   - `/quran` - Al-Quran reader
   - `/shalat` - Prayer times
   - `/hadith` - Hadith collection
   - `/doa` - Doa collection
3. Check browser console untuk errors
4. Check `writable/logs/` untuk error logs

---

## 🔄 MENGGANTI API (Future-Proof)

Jika suatu saat perlu ganti API:

### 1. Update Service Class
```php
// app/Libraries/QuranApiService.php
protected $baseUrl = 'https://new-api-url.com';
```

### 2. Update Method Mapping
```php
public function getSurahList()
{
    // Update endpoint dan response mapping
    $response = $this->client->get('/new-endpoint');
    $data = json_decode($response->getBody(), true);

    // Map response to expected format
    return $this->mapResponse($data);
}
```

### 3. Test Thoroughly
- Test all endpoints
- Check response format
- Update views jika perlu

---

## 📱 OFFLINE SUPPORT (Future Enhancement)

Untuk mendukung offline mode:

1. **Service Worker** (PWA)
2. **Local Storage** untuk cache
3. **IndexedDB** untuk data besar
4. **Fallback Data** dalam JSON files

---

## 🐛 TROUBLESHOOTING

### API tidak merespon
```
Error: cURL error 28: Connection timed out
```
**Solution:**
- Check internet connection
- Increase timeout di Service
- Check API status

### Empty Response
```
Warning: Trying to access array offset on value of type null
```
**Solution:**
- Add null checks
- Use `$data['key'] ?? []`
- Check API documentation

### Rate Limit Exceeded
```
Error: 429 Too Many Requests
```
**Solution:**
- Implement caching
- Reduce request frequency
- Use different API key/tier

---

## 📚 REFERENSI API DOCUMENTATION

1. **Quran API:** https://api-docs.quran.com/
2. **Aladhan Prayer Times:** https://aladhan.com/prayer-times-api
3. **Hadith API:** https://github.com/gadingnst/hadith-api
4. **Doa API:** https://github.com/mazipan/doa-harian-api

---

## ✅ CHECKLIST INTEGRASI

- [x] QuranApiService implemented
- [x] DoaApiService implemented
- [x] PrayerApiService implemented
- [x] HadithApiService implemented
- [x] StoryApiService implemented
- [x] Error handling added
- [x] Logging implemented
- [x] BaseController helpers
- [x] All views updated
- [x] Testing completed
- [x] Documentation created

---

## 🎯 NEXT STEPS (Optional)

1. **Add Caching Layer**
   - Redis atau File cache
   - TTL configuration
   - Cache invalidation

2. **Add API Monitoring**
   - Response time tracking
   - Error rate monitoring
   - Uptime checking

3. **Add Offline Support**
   - Progressive Web App
   - Service Workers
   - Local data fallback

4. **Add API Analytics**
   - Usage statistics
   - Popular endpoints
   - Performance metrics

---

**Portal Islami sudah siap production dengan full API integration!** 🚀

Semua fitur bekerja dengan sempurna menggunakan API eksternal.
