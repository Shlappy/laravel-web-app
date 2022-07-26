import './bootstrap';

import Alpine from 'alpinejs';
import product from './alpine/product.js';

window.Alpine = Alpine;
Alpine.data('product', product);

Alpine.start();

// Main app scripts
import './main';
import './site';