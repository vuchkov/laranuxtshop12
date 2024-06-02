<script>
import ProductService from '~/services/ProductService';

export default {
  async asyncData() {
    const products = await ProductService.getProducts();
    return { products };
  },
};
</script>
<template>
  <div>
    <h1>Products</h1>
    <ul>
      <li v-for="product in products" :key="product.id">
<!--        <NuxtLink :to={"/products/${product.id}"}>-->
        <NuxtLink to="/products/">
          {{ product.name || product.sku }}
        </NuxtLink>
      </li>
    </ul>
  </div>
</template>
