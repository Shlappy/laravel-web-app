<script setup>
import { ref } from 'vue';

const props = defineProps({
  buttonType: {
    type: String,
    default: 'primary',
    required: false,
    validator(value) {
      return ['primary', 'secondary', 'round'].includes(value);
    }
  }
});

const mainClass = ref(`button__${props.buttonType}`);
</script>

<template>
  <button class="button" :class="mainClass">
  <div :class="buttonType"></div>
    <slot></slot>
  </button>
</template>
