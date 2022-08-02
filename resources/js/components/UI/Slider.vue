<script setup>
defineProps({
  options: Object,
});
</script>

<template>
  <div class="slider-wrapper filter-item__slider pd">
    <div
      class="slider"
      :class="`slider-${options.type}`"
      :min="options.max"
      :max="options.max"
    ></div>

    <div v-if="options.type === 'between'" class="form-input__row">
      <input
        type="number"
        name="min"
        :min="options.max"
        :max="options.max"
        class="form-input slider__input slider__input-min"
      />
      <input
        type="number"
        name="max"
        :min="options.max"
        :max="options.max"
        class="form-input slider__input slider__input-max"
      />
    </div>
  </div>
</template>
