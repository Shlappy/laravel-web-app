<script setup>
import { onMounted, reactive, ref } from "vue";

const props = defineProps({
  options: Object,
});

const options = props.options;
options.min = parseInt(options.filter_options[0].numeric_value);
options.max = parseInt(options.filter_options[options.filter_options.length-1].numeric_value);

const inputs = reactive({
  min: null,
  max: null,
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
  inputs.min = options.min;
  inputs.max = options.max;
  updateSlider();
}

onMounted(() => {
  noUiSlider.create(slider.value, sliderData);

  slider.value.noUiSlider.on("update", (values, handle) => {
    if (handle) {
      inputs.max = Math.round(values[handle]);
    } else {
      inputs.min = Math.round(values[handle]);
    }
  });
});

const updateSlider = () => {
  slider.value.noUiSlider.set([inputs.min, inputs.max]);
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
        v-model="inputs.min"
        @change="updateSlider"
        :min="options.min"
        :max="options.max"
        class="form-input slider__input slider__input-min"
      />
      <input
        type="number"
        name="max"
        @change="updateSlider"
        v-model="inputs.max"
        :min="options.min"
        :max="options.max"
        class="form-input slider__input slider__input-max"
      />
    </div>
  </div>
</template>
