const CACHE_NAME = 'v1';
const urlsToCache = [
    '/',
    'index.php',
    'views/login.php',
    'assets/css/bootstrap.min.css',
    'assets/css/styles.css',
    'assets/js/bootstrap.bundle.min.js',
    'assets/js/app.js'
];

self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(cache => {
                return cache.addAll(urlsToCache);
            })
    );
});

self.addEventListener('fetch', event => {
    event.respondWith(
        caches.match(event.request)
            .then(response => {
                return response || fetch(event.request);
            })
    );
});
