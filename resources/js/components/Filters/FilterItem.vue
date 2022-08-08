<script setup>
import Slider from "@/components/UI/Slider.vue";
import { ref } from "vue";

const props = defineProps({
  filterData: {
    type: Object,
    required: true,
  },
});

const filterData = props.filterData,
  filterOptions = ref([]),
  slider = ref(null);

/**
 * Return checked options
 */
function checkedOptions() {
  let checked = [];

  filterOptions.value.forEach((el) => {
    if (el.checked) checked.push(el.dataset.value);
  });

  if (!checked.length) return false;

  return checked;
}

/**
 * Return slider input options
 *
 * return false if slider inputs aren't changed
 */
function sliderOptions() {
  const options = slider.value.options;
  const inputs = slider.value.inputs;

  if (options.min === inputs.min && options.max === inputs.max) {
    return false;
  }

  return inputs;
}

/**
 * Reset current filter to it's initial state
 */
function reset() {
  if (filterData.type === "between") {
    slider.value.reset();
  }
  if (filterData.type === "checkbox") {
    filterOptions.value.forEach((el) => {
      el.checked = false;
    });
  }
}

defineExpose({
  filterData,
  checkedOptions,
  sliderOptions,
  reset,
});
</script>

<template>
  <div
    class="filter-item"
    :data-name="filterData.slug"
    :data-type="filterData.type"
  >
    <div class="filter-item__wrapper">
      <a
        v-collapsible
        class="filter-item__toggle pd"
        :class="{
          'filter-item__toggle--between': filterData.type === 'between',
        }"
        href="#"
      >
        {{ filterData.name }}
      </a>

      <div class="filter-item__inner">
        <div class="filter-item__content">
          <Slider
            ref="slider"
            v-if="filterData.type === 'between'"
            :options="filterData"
          />

          <ul v-if="filterData.type === 'checkbox'" class="filter-item__list">
            <label
              v-for="option in filterData.filter_options"
              :key="option.slug"
              class="filter-item__list-item form-input__checkbox pd"
            >
              <span>{{ option.string_value }}</span>
              <input
                ref="filterOptions"
                type="checkbox"
                class="form-input__checkbox-input"
                :data-value="option.slug"
                @click.stop
              />
            </label>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>
