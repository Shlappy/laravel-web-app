/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries.
 */

import './bootstrap';
import './main';
import { createApp, onBeforeMount } from 'vue';
import { createPinia } from 'pinia'
import { useCartStore } from "./components/stores/cartStore.js";

/**
 * Next, we will create a fresh Vue application instance.
 */

const app = createApp({
  setup() {
    const cart = useCartStore();

    onBeforeMount(() => {
      cart.initialize();
    })
  }
});

app.directive('collapsible', {
  mounted: (el) => {
    el.addEventListener("click", function () {
      this.classList.toggle("active");
      var content = this.nextElementSibling;
      if (content.style.maxHeight) {
        content.style.maxHeight = null;
      } else {
        content.style.maxHeight = content.scrollHeight + "px";
      }
    });
  }
})

app.use(createPinia());

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Object.entries(import.meta.globEager('./**/*.vue')).forEach(([path, definition]) => {
  app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
});

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app".
 */

app.mount('#app');
