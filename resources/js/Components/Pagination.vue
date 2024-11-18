<template>

 <div class="rounded-b-2xl flex items-center justify-between bg-white p-4">
            <span class="text-[#667085] text-[14px]"> <p class="text-sm text-gray-700">
          Mostrando
          <span class="font-medium">{{ links?.current_page }}</span>
          de
          <span class="font-medium">{{ links?.last_page }}</span>
          total
          <span class="font-medium">{{links?.data?.length}}</span>
          Registro(s)
        </p></span>
            <div class="flex items-center gap-3">
             <div v-if="links?.links?.length > 2">
        <div class="flex flex-wrap -mb-1">
          <template v-for="(link, key) in links?.links">
            <div v-if="link.url === null" :key="key" class="w-[92px] h-[32px] flex items-center justify-center rounded-[5px] bg-secundary text-black" v-html="link.label" />
            <Link preserve-scroll v-else :key="key + 1" class="w-[32px] h-[32px] mr-1 ml-1 flex items-center justify-center rounded-[5px] bg-primary text-white" :class="{ 'text-whitebg-primary shadow-md': link.active }" :href="`${link.url}&limit=${props.limit}&searchBy=${props.searchBy}`" v-html="link.label" />
          </template>
        </div>
      </div>           
            </div>
          </div>


  <br>
 </template>



<script setup>
import { Link, usePage } from "@inertiajs/inertia-vue3";
import { defineProps, watch } from "vue";

const props = defineProps({
  links: Object,
  limit: Object,
  searchBy: Object,
  byStatus: Object,
});

watch(
  () => props.limit,
  (newValue, oldValue) => {
    if (newValue !== oldValue) {
      const url = `${window.location.pathname}?page=1&limit=${newValue}&searchBy=${props.searchBy}`;
      window.location.replace(url);
    }
  }
);


</script>

<style>
</style>