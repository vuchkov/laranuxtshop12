export interface CartItem {
  product: any; // Replace with your product type
  quantity: number;
}

export function useCart(): { getCart: () => CartItem[]; addToCart: (product: any, quantity: number) => void } {
  const getCart = (): CartItem[] => {
    const cartString = localStorage.getItem('cart');
    if (cartString) {
      return JSON.parse(cartString) as CartItem[];
    }
    return [];
  };

  const addToCart = (product: any, quantity: number) => {
    const cart = getCart();
    const existingItem = cart.find((item) => item.product.id === product.id);
    if (existingItem) {
      existingItem.quantity += quantity;
    } else {
      cart.push({ product, quantity });
    }
    localStorage.setItem('cart', JSON.stringify(cart));
  };

  return { getCart, addToCart };
}
