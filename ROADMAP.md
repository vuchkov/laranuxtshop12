# Roadmap & Rough Estimation

## Backend (Laravel):

### 1. Database Setup (1 hour):

- Create a migration to define the `products` table with columns for `id`, `sku`, `name`, `description`, `unit_price`, and `category_id` (foreign key to a `categories` table if needed).
- Create a migration for the `orders` table with columns for `id`, `reference`, `email`, `total_price`, and `paid` (boolean).
- Optionally, create a `categories` table with columns for `id` and `name` if you want to store categories separately.
- Seed some initial data (products and potentially categories) for testing purposes.

### 2. Product API (2 hours):

- Create a `Product` model with relationships to the `Category` model (if applicable).
- Create a `ProductController` using Laravel's resource controller functionality.

Implement methods for:
- `index`: Retrieves a paginated list of products using Laravel's built-in pagination features.
- `show`: Retrieves a specific product by ID.
- `store`: Validates and stores a new product.
- `update`: Validates and updates an existing product.
- `destroy`: Deletes a product by ID.

### 3. Order API (2 hours):

- Create an `Order` model with a relationship to the `Product` model (through an `OrderProduct` model for many-to-many relationships).
- Create an `OrderController` with a method for `store`.

This method should:
- Generate a unique order reference using the provided logic (year, month, day, padded order ID with offset).
- Allow adding multiple products to the order with quantities (consider using an array of product IDs and quantities).
- Calculate the total order price based on product quantities and unit prices.
- Save the order and associated products to the database.
- Utilize Laravel's Mollie integration to create a payment link with the order reference.
- Optionally, send an order confirmation email containing order details and the payment link.

### 4. Hubspot Integration (1 hour):

- Use the HubSpot PHP library to interact with HubSpot's API.
- Within the `OrderController`'s `store` method, upon successful payment (webhook notification or other mechanism), create a contact in HubSpot for the customer's email address.
- If the user provides company information, create an organization associated with the contact.
- Create a deal in HubSpot with the order reference, customer email, and total amount.

## Frontend (Nuxt.js v3):

### 1. Project Setup (0.5 hours):

Use `npx create-nuxt-app your-frontend-name` to create a new Nuxt.js project.

### 2. API Calls (1.5 hours):

- Install Axios for making API requests from Nuxt.js components.
- Create composables (reusable functions) for fetching data (products, specific product, etc.) using Axios calls to the Laravel API endpoints.

### 3. Cart Management (1 hour):

- Use Vuex or local storage (consider browser compatibility) to store cart items (product IDs, quantities) in the frontend.
- Create components for displaying the cart contents, allowing quantity changes, and calculating the total price.

### 4. Product Listing and Detail (1 hour):

- Create components for displaying product listings and individual product details.
- Use the composables to fetch product data from the API and populate the components.
- Allow adding products to the cart from the product detail page.

### 5. Order Placement and Payment (1 hour):

- Create a component for the cart overview page.
- Use the cart data to display items, quantities, and total price.
- Upon placing an order, trigger an API call to the order endpoint (passing cart data) and handle the response.
- Redirect the user to the payment link received from the API.

#### Additonal:

- Use validation and error handling on both backend and frontend for robustness.
- Implement proper authentication mechanisms if user accounts are needed.
- Consider using a state management library (Vuex) for more complex frontend interactions.
- Focus on completing core functionalities first, then refine the UI based on the Figma design or provided QR code.

This is a high-level roadmap, and the specific implementation details will vary depending on your preferences and chosen tools.

