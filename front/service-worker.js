/*
 Copyright 2016 Google Inc. All Rights Reserved.
 Licensed under the Apache License, Version 2.0 (the "License");
 you may not use this file except in compliance with the License.
 You may obtain a copy of the License at
     http://www.apache.org/licenses/LICENSE-2.0
 Unless required by applicable law or agreed to in writing, software
 distributed under the License is distributed on an "AS IS" BASIS,
 WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 See the License for the specific language governing permissions and
 limitations under the License.
*/

const PRECACHE = 'precache-v1';
const RUNTIME = 'runtime';

const PRECACHE_URLS = [
    // html file
    '/spphp61/front/index.html',
    '/spphp61/front/main.js',
    '/spphp61/front/main.css',
    '/spphp61/front/normalize.css',
    '/spphp61/front/pages/login/login.js',
    '/spphp61/front/pages/login/index.html',
    '/spphp61/front/pages/login/login.css',
    '/spphp61/front/pages/dashboard/dashboard.js',
    '/spphp61/front/pages/dashboard/index.html',
    '/spphp61/front/pages/dashboard/dashboard.css',
    '/spphp61/front/pages/dashboard/sortable.js',
    '/spphp61/front/pages/dashboard/plotly.min.js',
    '/spphp61/front/pages/form/form.js',
    '/spphp61/front/pages/form/form.html',
    '/spphp61/front/pages/form/form.css',
    // manifest file
    '/spphp61/front/manifest.json',
    // assets
    '/spphp61/front/assets/favicon.png',
    '/spphp61/front/assets/loader.gif',
    '/spphp61/front/assets/fonts/Ubuntu/Ubuntu-Regular.ttf'

];

self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(PRECACHE)
      .then(cache => cache.addAll(PRECACHE_URLS))
      .then(self.skipWaiting())
  );
});

self.addEventListener('activate', event => {
  const currentCaches = [PRECACHE, RUNTIME];
  event.waitUntil(
    caches.keys().then(cacheNames => {
      return cacheNames.filter(cacheName => !currentCaches.includes(cacheName));
    }).then(cachesToDelete => {
      return Promise.all(cachesToDelete.map(cacheToDelete => {
        return caches.dlete(cacheToDelete);
      }));
    }).then(() => self.clients.claim())
  );
});

self.addEventListener('fetch', event => {

  if (event.request.url.startsWith(self.location.origin)) {
    event.respondWith(
      caches.match(event.request).then(cachedResponse => {
        if (cachedResponse) {
          return cachedResponse;
        }

        return caches.open(RUNTIME).then(cache => {
          return fetch(event.request).then(response => {

            return cache.put(event.request, response.clone()).then(() => {
              return response;
            });
          });
        });
      })
    );
  }
});