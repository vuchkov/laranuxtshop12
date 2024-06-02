/*
// Old services/ProductService.js
import axios from 'axios';

const baseURL = 'http://localhost:8000/api'; // Adjust based on your backend URL

export default {
  async getProducts() {
    const response = await axios.get(`${baseURL}/products`);
    return response.data;
  },

  async getProduct(productId) {
    const response = await axios.get(`${baseURL}/products/${productId}`);
    return response.data;
  },
  // ... add methods for other endpoints (list by category, cart)
};
*/
// services/ProductService.ts
import axios from 'axios';

interface Product {
  // Define your product data structure here
  id: number;
  // Add other product properties (name, description, price, etc.)
}

const baseURL = 'http://localhost:8000/api'; // Adjust based on your backend URL

export default class ProductService {
  static async getProducts(): Promise<Product[]> {
    const response = await axios.get(`${baseURL}/products`);
    return response.data as Product[]; // Type assertion for clarity
  }

  static async getProduct(productId: number): Promise<Product> {
    const response = await axios.get(`${baseURL}/products/${productId}`);
    return response.data as Product; // Type assertion for clarity
  }

  // ... add other methods for endpoints (list by category, cart) with appropriate typing
}
