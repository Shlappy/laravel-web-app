import './bootstrap';

import Alpine from 'alpinejs';
import product from './alpine/data/product';
import './alpine/store/cart';
import './alpine/store/products';

window.Alpine = Alpine;
Alpine.data('product', product);

Alpine.start();

// Main app scripts
import './main';
