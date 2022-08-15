<script setup>
import axios from 'axios';
import DataTable from 'datatables.net-vue3';
import { ref, onMounted } from 'vue';

const props = defineProps({
  initData: Array,
  tags: Array,
});

const columns = [
  { data: 'created_at' },
  { data: 'INN' },
  { data: 'name' },
  { data: 'debit' },
  { data: 'purpose' },
  { data: 'tag.name' },
  { data: 'comment' },
];

let dt;
const data = ref(props.initData);
const table = ref();
const currentTag = ref(null);

const applyTag = (id) => {
  console.log(currentTag.value);

  if (currentTag.value === id) {
    axios.get(`/statements`).then((res) => data.value = res.data);
    currentTag.value = null;
  } else {
    axios.get(`/statements/tag/${id}`).then((res) => data.value = res.data);
    currentTag.value = id;
  }
}

onMounted(function () {
  // Get a DataTables API reference
  dt = table.value.dt();
});
</script>

<template>
  <div>
    <div>Теги:</div>
    <ul v-for="tag in tags" :key="tag.id">
      <li @click="applyTag(tag.id)" :data-id="tag.id">{{ tag.name }}</li>
    </ul>
  </div>

  <DataTable 
    :columns="columns"
    :data="data"
    ref="table"
    class="display">
    <thead>
      <tr>
        <th>Дата</th>
        <th>ИНН</th>
        <th>Наименование</th>
        <th>Дебет</th>
        <th>Назначение платежа</th>
        <th>Тег</th>
        <th>Комментарий</th>
      </tr>
    </thead>
  </DataTable>
</template>

<style>
@import 'datatables.net-dt';
</style>