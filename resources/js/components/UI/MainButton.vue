<script setup>
import { ref } from 'vue';

const props = defineProps({
  buttonType: {
    type: String,
    default: '',
    required: false,
    validator(value) {
      return ['primary', 'secondary', 'round', ''].includes(value);
    }
  }
});

const mainClass = props.buttonType ? ref(`button__${props.buttonType}`) : '';
</script>

<template>
  <button class="button" :class="mainClass">
    <slot></slot>
  </button>
</template>
