<!-- AchievementCard.vue -->
<template>
  <div >
  <div class="flex items-center justify-between">
      <div>  
       </div>
      <div class="flex gap-3">
        <Link v-if="RotaCadastro" as="button" :href="RotaCadastro" 
          class="w-[200px] bg-primary text-[16px] font-semibold rounded-[12px] flex items-center justify-center h-[56px] gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
            <path fill-rule="evenodd"
              d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z"
              clip-rule="evenodd" />
          </svg>
          <span>Cadastro</span>
        </Link>
        <a v-if="RotaExcel"  as="button" :href="RotaExcel"  target="_blank"
          class="w-[200px] bg-primary text-[16px] font-semibold rounded-[12px] flex items-center justify-center h-[56px] gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
            <path
              d="M12.75 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM7.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM8.25 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM9.75 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM10.5 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM12.75 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM14.25 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 13.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" />
             <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 7.5h-.75A2.25 2.25 0 0 0 4.5 9.75v7.5a2.25 2.25 0 0 0 2.25 2.25h7.5a2.25 2.25 0 0 0 2.25-2.25v-7.5a2.25 2.25 0 0 0-2.25-2.25h-.75m0-3-3-3m0 0-3 3m3-3v11.25m6-2.25h.75a2.25 2.25 0 0 1 2.25 2.25v7.5a2.25 2.25 0 0 1-2.25 2.25h-7.5a2.25 2.25 0 0 1-2.25-2.25v-.75" />

          </svg>
          <span>Exportar Excel</span>
        </a>
      </div>
    </div>
        <div class="mt-[24px] flex gap-3">
      <div class="flex-grow bg-white rounded-2xl flex gap-2 p-3 items-center">
        <div class="bg-primary rounded-full w-[50px] h-[50px] flex items-center justify-center">
          <span class="text-secundary text-[20px] font-bold">{{ props.Registros.total || 0 }}</span>
        </div>
        <div class="flex flex-col">
          <p class="mb-0 text-[16px] font-bold text-gray-400/90">Ativos e Inativos</p>
          <h1 class="text-[18px] font-bold">Total</h1>
        </div>
      </div>
      <div class="flex-grow bg-white rounded-2xl flex gap-2 p-3 items-center">
        <div class="bg-primary rounded-full w-[50px] h-[50px] flex items-center justify-center">
          <span class="text-secundary text-[20px] font-bold">{{
              props.Registros.ativo || 0
            }}</span>
        </div>
        <div class="flex flex-col">
          <p class="mb-0 text-[16px] font-bold text-gray-400/90">Ativos</p>
          <h1 class="text-[18px] font-bold">Total</h1>
        </div>
      </div>
      <div class="flex-grow bg-white rounded-2xl flex gap-2 p-3 items-center">
        <div class="bg-primary rounded-full w-[50px] h-[50px] flex items-center justify-center">
          <span class="text-secundary text-[20px] font-bold">{{
              props.Registros.inativo || 0
            }}</span>
        </div>
        <div class="flex flex-col">
          <p class="mb-0 text-[16px] font-bold text-gray-400/90">Inativos</p>
          <h1 class="text-[18px] font-bold">Total</h1>
        </div>
      </div>
      <div class="flex-grow bg-white rounded-2xl flex gap-2 p-3 items-center">
        <div class="bg-primary rounded-full w-[50px] h-[50px] flex items-center justify-center">
          <span class="text-secundary text-[20px] font-bold">{{
              props.Registros.mes || 0
            }}/{{ props.Registros.total || 0 }}</span>
        </div>
        <div class="flex flex-col">
          <p class="mb-0 text-[16px] font-bold text-gray-400/90">Este Mês</p>
          <h1 class="text-[18px] font-bold">Total</h1>
        </div>
      </div>
    </div>
 
  </div>
</template>

<script>
export default {
  name: "AchievementCard",
};
</script>
<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { ref, computed, defineProps, onMounted } from "vue";

const props = defineProps({
  token: Object,
  Registros: Object,
  RotaCadastro: Object,
  RotaExcel: Object,
});

const total = props.Registros.total || 1;
const ativos = props.Registros.ativo || 0;
const inativos = props.Registros.inativo || 0;
const mes = props.Registros.mes || 0;

let porcentagemAtivos = ((ativos * 100) / total).toFixed(2);
let porcentagemInativos = ((inativos * 100) / total).toFixed(2);
let porcentagemMes = ((mes * 100) / total).toFixed(2);

if (porcentagemAtivos > 100) {
  porcentagemAtivos = 100;
}

if (porcentagemInativos > 100) {
  porcentagemInativos = 100;
}
if (porcentagemMes > 100) {
  porcentagemMes = 100;
}
</script>
<style scoped>
/* Estilos opcionais adicionais para os cartões aqui */
</style>
