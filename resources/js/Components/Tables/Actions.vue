<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <Menu as="div" class="inline-block text-left">
    <div>
      <MenuButton class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-3 py-1 hover:bg-primary text-sm font-medium text-gray-700 over:text-white focus:outline-none ">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
        </svg>

        
      </MenuButton>
    </div>
    <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
      <MenuItems class="origin-top-right z-50  absolute  mt-2 w-36 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none">
        <MenuItem v-slot="{ active }">
        <a href="#" @click="edit" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'group flex items-center px-4 py-2 text-sm']">
          <PencilAltIcon class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" aria-hidden="true" />
          Ver / Editar
        </a>
        </MenuItem>
        <MenuItem v-slot="{ active }">
        <a href="#" @click="openDel = true" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'group flex items-center px-4 py-2 text-sm']">
          <TrashIcon class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" aria-hidden="true" />
          Excluir
        </a>
        </MenuItem>   
        <MenuItem v-slot="{ active }" v-if="props.routeResendPassword">
        <a title="Clique para Send Password por e-mail para o usuário" :href="props.routeResendPassword" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'group flex items-center px-4 py-2 text-sm']">
          <RefreshIcon class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" aria-hidden="true" />
          Password
        </a>
        </MenuItem>
      </MenuItems>
    </transition>
  </Menu>
  <!-- Modal Delete -->
  <Delete v-model:open="openDel" @del="del" />
  <Reabrir v-model:open="openReabrir" @delReabrir="delReabrir" />

</template>

<script setup>
import Delete from "../Modals/Delete.vue";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import { ref, defineProps } from "vue";
import { Inertia } from "@inertiajs/inertia";
import {
  ArchiveIcon,
  ArrowCircleRightIcon,
  ChevronDownIcon,
  DuplicateIcon,
  HeartIcon,
  PencilAltIcon,
  TrashIcon,
  RefreshIcon,
  UserAddIcon,
} from "@heroicons/vue/solid";
import { useToast } from "vue-toastification";

const toast = useToast();

const props = defineProps({
  routeUpdate: String,
  routeDel: String,
  routeResendPassword: { type: String, default: null },
  routeReabrirPermissao: String,
});

const openDel = ref(false);

function del() {
  Inertia.post(props.routeDel);
}


function edit() {
  Inertia.visit(props.routeUpdate);
}
</script>
