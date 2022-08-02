<script setup>
import Slider from "@/components/UI/Slider.vue";

defineProps({
  filter: {
    type: Object,
    required: true,
  },
});
</script>

<template>
  <div
    data-role="filter"
    class="filter-item"
    :data-name="filter.slug"
    :data-type="filter.type"
  >
    <div class="filter-item__wrapper">
      <a v-collapsible
        class="filter-item__toggle pd"
        :class="{ 'filter-item__toggle--between': filter.type === 'between' }"
        href="#"
      >
        {{ filter.name }}
      </a>

      <div class="filter-item__inner">
        <div class="filter-item__content">
          <Slider v-if="filter.type === 'between'" :options="filter" />

          <ul v-if="filter.type === 'checkbox'" class="filter-item__list">
            <label
              v-for="spec in filter.values" :key="spec.code"
              class="filter-item__list-item form-input__checkbox pd"
            >
              <span>{{ spec.value }}</span>
              <input
                type="checkbox"
                class="form-input__checkbox-input"
                :data-value="spec.code"
              />
            </label>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>
