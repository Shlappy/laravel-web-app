<script setup>
import { computed } from '@vue/reactivity';

const props = defineProps({
  paginationData: Object
});

const emit = defineEmits(['newPage']);

const pagination = props.paginationData,
  offset = 5;

/**
 * How many pages to show
 */
const pages = computed(() => {
  let pages = [];
  let from = pagination.current_page - Math.floor(offset / 2);
  if (from < 1) {
    from = 1;
  }
  let to = from + offset - 1;
  if (to > pagination.last_page) {
    to = pagination.last_page;
  }
  while (from <= to) {
    pages.push(from);
    from++;
  }

  return pages;
})

const isCurrentPage = (page) => {
  return pagination.current_page === page;
}

const changePage = (page) => {
  if (page > pagination.last_page) page = pagination.last_page;

  pagination.current_page = page;
  emit('newPage', page);
}
</script>

<!-- <script>
// fetchPosts() {
  // axios.get(`/api/search/${this.route.params.name}?page=` + this.pagination.current_page)
    // .then(response => {
      // this.posts = response.data.data.data;
      // this.pagination = response.data.pagination;
    // })
    // .catch(error => console.error(error))
    // .finally(() => {
      // const page = this.pagination.current_page;
    // });
// },
</script> -->

<template>
  <nav class="pagination is-centered is-rounded" role="navigation" aria-label="pagination">
    <div class="pagination__inner">
      <a class="pagination__link pagination__first" @click.prevent="changePage(1)"
        :disabled="pagination.current_page <= 1">First page</a>
      <a class="pagination__link pagination__prev" @click.prevent="changePage(pagination.current_page - 1)"
        :disabled="pagination.current_page <= 1">Previous</a>

      <div class="pagination__list">
        <span v-for="page in pages" class="pagination__link-page">
          <a class="pagination__link" :class="isCurrentPage(page) ? 'is-current' : ''"
            @click.prevent="changePage(page)">{{ page }}</a>
        </span>
      </div>

      <a class="pagination__link pagination__next" @click.prevent="changePage(pagination.current_page + 1)"
        :disabled="pagination.current_page >= pagination.last_page">Next page</a>
      <a class="pagination__link pagination__last" @click.prevent="changePage(pagination.last_page)"
        :disabled="pagination.current_page >= pagination.last_page">Last page</a>
    </div>
  </nav>
</template>
