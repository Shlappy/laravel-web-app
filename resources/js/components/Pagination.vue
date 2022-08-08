<script setup>
import { computed } from "@vue/reactivity";

const props = defineProps({ pagination: Object }),
  emit = defineEmits(["newPage"]);

/**
 * How many pages to show
 */
const offset = 5;

const pages = computed(() => {
  let pages = [];
  let from = props.pagination.current_page - Math.floor(offset / 2);

  if (from < 1) from = 1;

  let to = from + offset - 1;

  if (to > props.pagination.last_page) to = props.pagination.last_page;

  while (from <= to) {
    pages.push(from);
    from++;
  }

  return pages;
});

const isCurrentPage = (page) => {
  return props.pagination.current_page === page;
};

const changePage = (page) => {
  if (page > props.pagination.last_page) page = pagination.last_page;
  emit("newPage", page);
};
</script>

<template>
  <nav
    v-if="pagination"
    class="pagination is-centered is-rounded"
    role="navigation"
    aria-label="pagination"
  >
    <div class="pagination__inner">
      <a
        class="pagination__link pagination__first"
        @click.prevent="pagination.current_page <= 1 ? '' : changePage(1)"
        :disabled="pagination.current_page <= 1"
        >First page
      </a>
      <a
        class="pagination__link pagination__prev"
        @click.prevent="pagination.current_page <= 1 ? '' : changePage(pagination.current_page - 1)"
        :disabled="pagination.current_page <= 1"
        >Previous
      </a>

      <div class="pagination__list">
        <span v-for="page in pages" class="pagination__link-page">
          <a
            class="pagination__link"
            :class="isCurrentPage(page) ? 'is-current' : ''"
            @click.prevent="changePage(page)"
            >{{ page }}</a
          >
        </span>
      </div>

      <a
        class="pagination__link pagination__next"
        @click.prevent="pagination.current_page >= pagination.last_page ? '' : changePage(pagination.current_page + 1)"
        :disabled="pagination.current_page >= pagination.last_page"
        >Next page</a
      >
      <a
        class="pagination__link pagination__last"
        @click.prevent="pagination.current_page >= pagination.last_page ? '' : changePage(pagination.last_page)"
        :disabled="pagination.current_page >= pagination.last_page"
        >Last page</a
      >
    </div>
  </nav>
</template>
