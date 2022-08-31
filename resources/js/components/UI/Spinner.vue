<script setup>

</script>

<template>
  <div class="spinner">
    <button @click="decrement" class="spinner__button spinner__button-minus">
      <i class="spinner__icon">−</i>
    </button>

    <input class="spinner__input" />

    <button @click="increment" class="spinner__button spinner__button-plus">
      <i class="spinner__icon">+</i>
    </button>
  </div>
</template>
