<script setup>
import { onMounted, reactive, ref } from "vue";

const props = defineProps({
  options: Object,
});

const options = props.options;
options.min = parseInt(props.options.min);
options.max = parseInt(props.options.max);

const inputs = reactive({
  minRange: null,
  maxRange: null,
});

const sliderData = {
  start: [options.min, options.max],
  connect: true,
  range: {
    min: options.min,
    max: options.max,
  },
  step: 1,
};

const slider = ref(null);

function reset() {
  inputs.minRange = options.min;
  inputs.maxRange = options.max;
  updateSlider();
}

onMounted(() => {
  noUiSlider.create(slider.value, sliderData);

  slider.value.noUiSlider.on("update", (values, handle) => {
    if (handle) {
      inputs.maxRange = Math.round(values[handle]);
    } else {
      inputs.minRange = Math.round(values[handle]);
    }
  });
});

const updateSlider = () => {
  slider.value.noUiSlider.set([inputs.minRange, inputs.maxRange]);
};

defineExpose({
  inputs,
  options,
  reset
});
</script>

<template>
  <div class="slider-wrapper filter-item__slider pd">
    <div
      ref="slider"
      class="slider"
      :class="`slider-${options.type}`"
      :min="options.min"
      :max="options.max"
    ></div>

    <div v-if="options.type === 'between'" class="form-input__row">
      <input
        type="number"
        name="min"
        v-model="inputs.minRange"
        @change="updateSlider"
        :min="options.min"
        :max="options.max"
        class="form-input slider__input slider__input-min"
      />
      <input
        type="number"
        name="max"
        @change="updateSlider"
        v-model="inputs.maxRange"
        :min="options.min"
        :max="options.max"
        class="form-input slider__input slider__input-max"
      />
    </div>
  </div>
</template>
