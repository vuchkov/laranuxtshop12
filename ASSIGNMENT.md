# Assignment

### Conditions

This is an individual assignment. Collaboration to complete the assignment is not allowed.
This assignment is time limited to 8 hours.

## Backend (Laravel)

### Products

Products have a unit price and fall under (at most) one of the three standard categories below. Additionally, they consist of an SKU (Stock Keeping Unit) and a product description.
- "Home"
- "Garden"
- "Kitchen"

#### With the API you want to:
- Retrieve a paginated list of products from the database
- Retrieve a specific product
- Add a product
- Update a product
- Delete a product

### Placing Orders

An order must be able to be placed on the webshop. Ensure that this can be done in a single call. At this stage, the buyer's personal details can be omitted (except for an email address).
It should, of course, be possible to order a product multiple times.

An order must also have a unique reference number. This is constructed as follows (concatenate rules into one string without extra spaces):
- F
- today → year (2023)
- today → month (01)
- today → day (03)
- order → id + offset value (default 500), minimum 5 characters, left-padded with 0

An order with id 123 on January 3, 2023, will be: F202301030623 (when the offset value is
500).

### Order Confirmation

When a buyer places an order, they should receive an email with a summary of what was
ordered and the order ID.

### Order Payment

When an order is placed, a payment link must be returned. This is done using Mollie (https://github.com/mollie/laravel-mollie). Ensure that the order reference is also sent to Mollie. In many applications, this is used for reconciliation (accounting-wise it's handy).

#### Order Paid?

Mollie offers the possibility to receive a webhook. By catching this webhook, we get updates about the payment. When the order is paid, the customer should receive a payment confirmation by email. (This can be the same email as the order confirmation, but with a different subject).

### Hubspot

When an order is paid, a Deal must be created in Hubspot 
(https://github.com/HubSpot/hubspot-php). This should be inserted under the Test account environment in Hubspot. Ensure that the order reference, the customer's email address, and the total amount are included.

A deal must always have a Contact. Ensure that the personal data is added to the contact.
If a contact belongs to a company, you also want the company details to be added to the Hubspot Contact. Therefore, when an order is paid, in addition to a Contact and a Deal, a Hubspot Organization should also be added.

## Frontend (Nuxt v3)

Each of the above endpoints should be called and used to display a frontend. The design of the frontend can be found on Figma: https://www.figma.com/design/JEj3olk2dDqPYP20jnzvrI/Frontend-Project-Webshop

### Cart

On the frontend a user should be able to add products to their cart (from the product
detail). This cart should be stored in memory on the frontend and be persisted when the user
refreshes the page.

In the navigation bar (top of the design) there is a button which has an indicator of the total sum of products in the cart (so not the amount of cart lines but the total of all quantities).

### Product overview

There should be an overview of the products which are retrieved from the created backend.

On this overview the user should see short information about the product and they should
see a button linking to the detail page of the product.

### Product detail

On the product detail page a user should see all they see on the overview, but the description displayed should be longer.

A user should also be able to add the product to their cart and choose the quantity of items to add to the cart.

### Cart overview

There should also be a cart overview page which is accessed from the button in the
navigation bar.

On this page a list should be displayed of all products in the cart. With each product the user should be able to change its quantity and see the total price per line.

The frontend should also calculate the total price of the cart and the user should be able to order the cart using the endpoint from the Backend. The frontend should receive a link where the payment can be made and they should be redirected to it.

