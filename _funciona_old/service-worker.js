// JavaScript Document

console.log('entro...');

var dataCacheName = 'wda-v1';
var cacheName = 'wda-cache-v1';
var filesToCache = [
  '/',
  '/index.php',
  '/app/js/app.js',
  'app/body-header.tpl',
  'app/body-slider.tpl',
  'app/body-seccion-ofrecemos.tpl',
  'app/body-datos.tpl',
  'app/body-contenidoresaltable.tpl',
  'app/body-mensajes.tpl',
  'app/body-footer.tpl',
  'app/body-scripts.tpl',
  'app/body-scripts-index.tpl'
];

self.addEventListener('install', function(event) {
  console.log('[ServiceWorker] Instalando...');
  event.waitUntil(
    caches.open(cacheName).then(function(cache) {
      console.log('[ServiceWorker] Guardando en cache...');
      return cache.addAll(filesToCache);
    })
  );
});

self.addEventListener('fetch', function(event) {
	console.log('[Service Worker] Fetch', e.request.url);
	/*
  event.respondWith(caches.match(event.request).then(function(response) {
    // caches.match() always resolves
    // but in case of success response will have value
    if (response !== undefined) {
      return response;
    } else {
      return fetch(event.request).then(function (response) {
        // response may be used only once
        // we need to save clone to put one copy in cache
        // and serve second one
        let responseClone = response.clone();
        
        caches.open('v1').then(function (cache) {
          cache.put(event.request, responseClone);
        });
        return response;
      }).catch(function () {
        return caches.match('/sw-test/gallery/myLittleVader.jpg');
      });
    }
  }));
  */
});

////////////////////////////////////////////////////////////////////////////

/*
self.addEventListener('activate', function(e) {
  console.log('[ServiceWorker] Activo...');
  e.waitUntil(
    caches.keys().then(function(keyList) {
      return Promise.all(keyList.map(function(key) {
        if (key !== cacheName && key !== dataCacheName) {
          console.log('[ServiceWorker] Removido el cache viejo...', key);
          return caches.delete(key);
        }
      }));
    })
  );
  return self.clients.claim();
});
*/