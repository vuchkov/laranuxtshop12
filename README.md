# Assignment

Please read the [ASSIGNMENT.md](https://github.com/vuchkov/laranuxtshop/blob/master/ASSIGNMENT.md) and [ROADMAP.md](https://github.com/vuchkov/laranuxtshop/blob/master/ROADMAP.md) for more info.

[//]: # (- The goal of the project is to create a template for development on Laravel and Nuxt with maximum API performance, ready-made authorization methods, image uploading with optimization and ready-made user roles.)

<!-- TOC -->

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Upgrade](#upgrade)
- [Usage](#usage)
    - [Nuxt $fetch](#nuxt-fetch)
    - [Authentication](#authentication)
    - [Nuxt Middleware](#nuxt-middleware)
    - [Laravel Middleware](#laravel-middleware)
- [Examples](#examples)
    - [Route list](#route-list)
    - [Demo](#demo)
- [Links](#links)
- [License](#license)

<!-- /TOC -->

## Features

 - [**Laravel 11**](https://laravel.com/docs/11.x) and [**Nuxt 3**](https://nuxt.com/)
 - [**Laravel Octane**](https://laravel.com/docs/11.x/octane) supercharges your application's performance by serving your application using high-powered application servers.
 - [**Laravel Telescope**](https://laravel.com/docs/11.x/telescope) provides insight into the requests coming into your application, exceptions, log entries, database queries, queued jobs, mail, notifications, cache operations, scheduled tasks, variable dumps, and more.
 - [**Laravel Sanctum**](https://laravel.com/docs/11.x/sanctum) Token-based authorization is compatible with **SSR** and **CSR**
 - [**Laravel Socialite**](https://laravel.com/docs/11.x/socialite) OAuth providers
 - [**Spatie Laravel Permissions**](https://spatie.be/docs/laravel-permission/v6/introduction) This package allows you to manage user permissions and roles in a database.
 - UI library [**Nuxt UI**](https://ui.nuxt.com/) based on [**TailwindCSS**](https://tailwindui.com/) and [**HeadlessUI**](https://headlessui.com/).
 - [**Pinia**](https://pinia.vuejs.org/ssr/nuxt.html) The intuitive store for Vue.js
 - Integrated pages: login, registration, password recovery, email confirmation, account information update, password change.
 - Temporary uploads with cropping and optimization of images.
 - Device management
 - [**ofetch**](https://github.com/unjs/ofetch) preset for working with Laravel API, which makes it possible
use $**fetch** without having to resort to custom $**fetch** wrappers.

## Requirements

 - PHP 8.2 / Node 20+
 - **Redis** is required for the [**Throttling with Redis**](https://laravel.com/docs/11.x/routing#throttling-with-redis) feature
 - [**Laravel Octane**](https://laravel.com/docs/11.x/octane) supports 2 operating modes: Swoole (php extension) or Roadrunner

## Installation
1. clone repository
2. `composer install`
3. `cp .env.example .env && php artisan key:generate && php artisan storage:link`
4. `php artisan migrate`
5. `php artisan db:seed`
6. `php artisan octane:install`
7. `php artisan octane:start --watch --port=8000 --host=127.0.0.1`
8. `php artisan migrate:fresh --seed`
9. Use yarn: `yarn install && yarn dev` or NPM: `npm install && npm run dev`
10. Check the API: 
11. Categories: http://127.0.0.1:8000/api/v1/categories
12. Products in Category 1: http://127.0.0.1:8000/api/v1/1/products

## Upgrade
1. `npx nuxi upgrade`
2. `composer update`

> Nuxt port is set in package.json scripts via **cross-env**

## Updates & Usage

Research on two Laravel & Nuxt boilerplate:
- https://github.com/fumeapp/laranuxt
- https://github.com/k2so-dev/laravel-nuxt

Laravel API: 
- http://127.0.0.1:8000/
- http://127.0.0.1:8000/api/v1/
- http://127.0.0.1:8000/api/v1/1/products (products of category 1)

### 1. Setup Laravel

Start with `laravel-nuxt`

Add `https://github.com/mollie/laravel-mollie` by composer

### 2. API Development in Laravel

#### 2.1 Create DB migrations:
```
php artisan make:migration create_products_table
php artisan make:migration create_orders_table
php artisan make:migration create_categories_table
```
- Run `php artisan migrate`
- Create seeders: `php artisan make:seeder ProductsSeeder` plus categories
  and orders
- Seed data `php artisan db:seed` and 
``` 
php artisan db:seed --class=ProductSeeder
php artisan db:seed --class=OrderSeeder
php artisan db:seed --class=CategorySeeder
```

To refresh DB:
``` 
php artisan migrate:fresh --seed
```

#### 2.2 Create models
- Create a Product model: `php artisan make:model Product`
- Create a Order model: `php artisan make:model Order`
- Create a Category model: `php artisan make:model Category`

(It's quicker to use `php artisan make:model Product -a` at once)

- Create all the models.

Implement in Order model `reference` field logic as method:
``` 
public function getReferenceNumberAttribute()
    {
        // Get today's date components
        $year = now()->format('Y');
        $month = now()->format('m');
        $day = now()->format('d');

        // Generate the reference number string
        return "F{$year}{$month}{$day}" . str_pad($this->id + 500, 5, '0', STR_PAD_LEFT);
    }
```

#### 2.3 Create controllers

- `php artisan make:controller`

#### 2.4 Create resources:

- `php artisan make:resource`

### 3. Frontend in Nuxt v.3

- Install axios: `yarn add axios`

#### 3.1 Products
- Create product service: `services/ProductService.ts`
- Create `pages/products.ts` (for tests)
- Create `pages/products/_id.ts`

#### 3.2 Cart 
- Create `composables/cart.ts`
- Explanation:

We define an interface `CartItem` to represent an item in the cart, 
including the product and its quantity.
The `useCart` function provides methods for:
`getCart`: Retrieves the cart items from local storage (parsed as `CartItem[]`).
`addToCart`: Adds a product to the cart, handling existing items and 
updating quantities.

#### 3.3. Using `useCart` in Components:
- Import useCart in your components:
```
<script setup>
import { useCart } from '~/composables/cart';
</script>
```

- Access methods:
```
<template>
  <button @click="addToCart(product, 1)">Add to Cart</button>
</template>

<script setup>
const { addToCart } = useCart();

const addToCart = (product, quantity) => {
  // Use addToCart method from composable
};
</script>
```

#### 3.4 Navigation Bar Cart Indicator:
Access Cart Items:
```
<template>
  <div>
    <NuxtLink to="/cart">Cart ({{ cartItems.length }})</NuxtLink>
  </div>
</template>

<script setup>
import { useCart } from '~/composables/cart';

const { getCart } = useCart();

const cartItems = computed(() => getCart());
</script>
```
Explanation:
- We access the getCart method from useCart to get cart items within a computed property. 
- We display the number of items in the cart within the navigation bar button.

#### 3.5 Cart page
Create `pages/cart.ts`

### Nuxt $fetch

To work with the api, the default path is **"/api/v1"**. All requests from **Nuxt** to the **Laravel API** can be executed without wrappers, as described in the **Nuxt.js** documentation. For example, the code for authorizing a user by email and password:
```vue
<script lang="ts" setup>
const router = useRouter();
const auth = useAuthStore();
const form = ref();
const state = reactive({
  email: "",
  password: "",
  remember: false,
});

const { refresh: onSubmit, status } = useFetch("login", {
  method: "POST",
  body: state,
  immediate: false,
  watch: false,
  async onResponse({ response }) {
    if (response?.status === 422) {
      form.value.setErrors(response._data?.errors);
    } else if (response._data?.ok) {
      auth.token = response._data.token;

      await auth.fetchUser();
      await router.push("/");
    }
  }
});

const loading = computed(() => status.value === "pending");
</script>
<template>
  <UForm ref="form" :state="state" @submit="onSubmit" class="space-y-4">
    <UFormGroup label="Email" name="email" required>
      <UInput
        v-model="state.email"
        placeholder="you@example.com"
        icon="i-heroicons-envelope"
        trailing
        type="email"
        autofocus
      />
    </UFormGroup>

    <UFormGroup label="Password" name="password" required>
      <UInput v-model="state.password" type="password" />
    </UFormGroup>

    <UTooltip text="for 1 month" :popper="{ placement: 'right' }">
      <UCheckbox v-model="state.remember" label="Remember me" />
    </UTooltip>

    <div class="flex items-center justify-end space-x-4">
      <NuxtLink class="text-sm" to="/auth/forgot">Forgot your password?</NuxtLink>
      <UButton type="submit" label="Login" :loading="loading" />
    </div>
  </UForm>
</template>
```
> In this example, a POST request will be made to the url **"/api/v1/login"**

### Authentication
**useAuthStore()** has everything you need to work with authorization.

Data returned by **useAuthStore**:
* `logged`: Boolean, whether the user is authorized
* `token`: Cookie, sanctum token
* `user`: User object, user stored in pinia store
* `logout`: Function, remove local data and call API to remove token
* `fetchUser`: Function, fetch user data

### Nuxt Middleware

The following middleware is supported:
* `guest`: unauthorized users
* `auth`: authorized users
* `verified`: users who have confirmed their email
* `role-user`: users with the 'user' role
* `role-admin`: users with the 'admin' role

### Laravel Middleware

All built-in middleware from Laravel + middleware based on roles [**Spatie Laravel Permissions Middleware**](https://spatie.be/docs/laravel-permission/v6/basic-usage/middleware)

## Links
* [Nuxt 3](https://nuxt.com/)
* [Nuxt UI](https://ui.nuxt.com/)
* [Tailwind CSS](https://tailwindcss.com/)
* [Laravel 11x](https://laravel.com/docs/11.x)
