<script setup>
const props = defineProps({
  count: {
    type: Number,
    default: 1,
  },
  isDisabled: {
    type: Boolean,
    default: false,
  },
});

const emit = defineEmits(["increment", "decrement", "inputChange"]);

function isNumber(event) {
  const keysAllowed = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
  const keyPressed = event.key;

  if (!keysAllowed.includes(keyPressed)) {
    event.preventDefault();
  }
}
</script>

<template>
  <div class="spinner" :class="{ disabled: isDisabled }">
    <button
      @click="$emit('decrement', count - 1)"
      :disabled="isDisabled"
      class="spinner__button spinner__button-minus"
    >
      <i class="spinner__icon">−</i>
    </button>

    <input
      @input="$emit('inputChange', count)"
      @keypress="isNumber($event)"
      :disabled="isDisabled"
      type="text"
      v-model="count"
      onpaste="return false;"
      class="spinner__input"
    />

    <button
      @click="$emit('increment', count + 1)"
      :disabled="isDisabled"
      class="spinner__button spinner__button-plus"
    >
      <i class="spinner__icon">+</i>
    </button>
  </div>
</template>
