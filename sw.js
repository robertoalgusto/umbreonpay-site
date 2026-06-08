const CACHE_NAME = 'umbreonpay-v1';
const urlsToCache = [
    '/umbreonpay-site/',
    '/umbreonpay-site/index.html',
    '/umbreonpay-site/login.html',
    '/umbreonpay-site/abrir-conta.html',
    '/umbreonpay-site/painel.html',
    '/umbreonpay-site/style.css',
    '/umbreonpay-site/assets/brasao.png'
];

self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(cache => cache.addAll(urlsToCache))
    );
});

self.addEventListener('fetch', event => {
    event.respondWith(
        caches.match(event.request)
            .then(response => response || fetch(event.request))
    );
});
