<template>
  <div>
    <h1>{{ product.name || product.sku }}</h1>
    <p>{{ product.description }}</p>
  </div>
</template>

<script>
import ProductService from '~/services/ProductService';

export default {
  async asyncData({ params }) {
    const productId = params.id;
    const product = await ProductService.getProduct(productId);
    return { product };
  },
};
</script>
