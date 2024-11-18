<template>
  <div class="lg:col-span-2">
    <hr class="my-5">
  </div>

  <div class="col-span-2">
    <section>
      <div class="flex flex-col justify-center h-full">
        <!-- Table -->
        <div class="w-full mx-auto bg-white rounded-sm border border-gray-200">
          <header class="px-5 py-4 border-b border-gray-100 flex items-center">
          <h2>Permissões</h2>
            <div class="ml-auto space-x-2 items-center text-sm">
              <Checkbox id="selectAll" @click="markAll(range(1, 25))" v-model="selectedAll" placeholder="Select all" class="ml-auto" :binary="true" />
              <label for="selectAll" v-if="!selectedAll">Marcar Todos</label>
              <label for="selectAll" v-else>Desmarcar Todos</label>
            </div>
          </header>
          <div class="p-3">
            <div class="overflow-x-auto">
              <table class="w-full  table-auto">
                <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                  <tr>
                    <th class="p-2 whitespace-nowrap">
                      <div class="font-semibold text-left">Módulo</div>
                    </th>
                    <th class="p-2 whitespace-nowrap">
                      <div class="font-semibold text-center">Marcar Linha</div>
                    </th>
                    <th class="p-2 whitespace-nowrap">
                      <div class="font-semibold">Listagem</div>
                    </th>
                    <th class="p-2 whitespace-nowrap">
                      <div class="font-semibold">Cadastro</div>
                    </th>
                    <th class="p-2 whitespace-nowrap">
                      <div class="font-semibold">Edição</div>
                    </th>
                    <th class="p-2 whitespace-nowrap">
                      <div class="font-semibold">Ver</div>
                    </th>
                    <th class="p-2 whitespace-nowrap">
                      <div class="font-semibold">Deletar</div>
                    </th>
                  </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-100">
           

    

<!-- #ModificaAqui -->

              <tr>
                  <td class='p-2 whitespace-nowrap'>
                    <div class='flex items-center'>
                    <div class='font-medium text-gray-800'>Planos</div>
                    </div>
                  </td>
                  <td class='p-2 text-center'>
                    <Checkbox @click='markLine(range(349, 353), 7)' v-model='lineChecked' class='ml-auto' :value='7' />
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='349' />
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='350' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='351' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='352' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='353' />
                    
                  </td>
              </tr>

              <tr>
                  <td class='p-2 whitespace-nowrap'>
                    <div class='flex items-center'>
                    <div class='font-medium text-gray-800'>Pagamentos</div>
                    </div>
                  </td>
                  <td class='p-2 text-center'>
                    <Checkbox @click='markLine(range(354, 358), 8)' v-model='lineChecked' class='ml-auto' :value='8' />
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='354' />
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='355' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='356' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='357' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='358' />
                    
                  </td>
                  </tr>
              <tr>
                  <td class='p-2 whitespace-nowrap'>
                    <div class='flex items-center'>
                    <div class='font-medium text-gray-800'>Bancos</div>
                    </div>
                  </td>
                  <td class='p-2 text-center'>
                    <Checkbox @click='markLine(range(359, 363), 9)' v-model='lineChecked' class='ml-auto' :value='9' />
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='359' />
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='360' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='361' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='362' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='363' />
                    
                  </td>
              </tr>

              <tr>
                  <td class='p-2 whitespace-nowrap'>
                    <div class='flex items-center'>
                    <div class='font-medium text-gray-800'>Acessos</div>
                    </div>
                  </td>
                  <td class='p-2 text-center'>
                    <Checkbox @click='markLine(range(364, 368), 10)' v-model='lineChecked' class='ml-auto' :value='10' />
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='364' />
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='365' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='366' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='367' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='368' />
                    
                  </td>
              </tr>
              <tr>
                  <td class='p-2 whitespace-nowrap'>
                    <div class='flex items-center'>
                    <div class='font-medium text-gray-800'>Campanhas</div>
                    </div>
                  </td>
                  <td class='p-2 text-center'>
                    <Checkbox @click='markLine(range(369, 373), 11)' v-model='lineChecked' class='ml-auto' :value='11' />
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='369' />
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='370' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='371' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='372' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='373' />
                    
                  </td>
              </tr>
              <tr>
                  <td class='p-2 whitespace-nowrap'>
                    <div class='flex items-center'>
                    <div class='font-medium text-gray-800'>Canais</div>
                    </div>
                  </td>
                  <td class='p-2 text-center'>
                    <Checkbox @click='markLine(range(374, 378), 12)' v-model='lineChecked' class='ml-auto' :value='12' />
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='374' />
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='375' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='376' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='377' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='378' />
                    
                  </td>
              </tr>
              <tr>
                  <td class='p-2 whitespace-nowrap'>
                    <div class='flex items-center'>
                    <div class='font-medium text-gray-800'>Chatbots</div>
                    </div>
                  </td>
                  <td class='p-2 text-center'>
                    <Checkbox @click='markLine(range(379, 383), 13)' v-model='lineChecked' class='ml-auto' :value='13' />
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='379' />
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='380' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='381' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='382' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='383' />
                    
                  </td>
              </tr>
              <tr>
                  <td class='p-2 whitespace-nowrap'>
                    <div class='flex items-center'>
                    <div class='font-medium text-gray-800'>Mensagem automatica</div>
                    </div>
                  </td>
                  <td class='p-2 text-center'>
                    <Checkbox @click='markLine(range(384, 388), 14)' v-model='lineChecked' class='ml-auto' :value='14' />
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='384' />
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='385' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='386' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='387' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='388' />
                    
                  </td>
              </tr>
              <tr>
                  <td class='p-2 whitespace-nowrap'>
                    <div class='flex items-center'>
                    <div class='font-medium text-gray-800'>Historico</div>
                    </div>
                  </td>
                  <td class='p-2 text-center'>
                    <Checkbox @click='markLine(range(389, 393), 15)' v-model='lineChecked' class='ml-auto' :value='15' />
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='389' />
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='390' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='391' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='392' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='393' />
                    
                  </td>
              </tr>
              <tr>
                  <td class='p-2 whitespace-nowrap'>
                    <div class='flex items-center'>
                    <div class='font-medium text-gray-800'>Tabulação</div>
                    </div>
                  </td>
                  <td class='p-2 text-center'>
                    <Checkbox @click='markLine(range(394, 398), 16)' v-model='lineChecked' class='ml-auto' :value='16' />
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='394' />
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='395' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='396' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='397' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='398' />
                    
                  </td>
              </tr>
              <tr>
                  <td class='p-2 whitespace-nowrap'>
                    <div class='flex items-center'>
                    <div class='font-medium text-gray-800'>Tags</div>
                    </div>
                  </td>
                  <td class='p-2 text-center'>
                    <Checkbox @click='markLine(range(399, 403), 17)' v-model='lineChecked' class='ml-auto' :value='17' />
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='399' />
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='400' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='401' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='402' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='403' />
                    
                  </td>
              </tr>
              <tr>
                  <td class='p-2 whitespace-nowrap'>
                    <div class='flex items-center'>
                    <div class='font-medium text-gray-800'>Avisos</div>
                    </div>
                  </td>
                  <td class='p-2 text-center'>
                    <Checkbox @click='markLine(range(404, 408), 18)' v-model='lineChecked' class='ml-auto' :value='18' />
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='404' />
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='405' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='406' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='407' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='408' />
                    
                  </td>
              </tr>
              <tr>
                  <td class='p-2 whitespace-nowrap'>
                    <div class='flex items-center'>
                    <div class='font-medium text-gray-800'>Administrador de empresa</div>
                    </div>
                  </td>
                  <td class='p-2 text-center'>
                    <Checkbox @click='markLine(range(409, 413), 19)' v-model='lineChecked' class='ml-auto' :value='19' />
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='409' />
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='410' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='411' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='412' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='413' />
                    
                  </td>
              </tr>
              <tr>
                  <td class='p-2 whitespace-nowrap'>
                    <div class='flex items-center'>
                    <div class='font-medium text-gray-800'>Tutoriais</div>
                    </div>
                  </td>
                  <td class='p-2 text-center'>
                    <Checkbox @click='markLine(range(414, 418), 20)' v-model='lineChecked' class='ml-auto' :value='20' />
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='414' />
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='415' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='416' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='417' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='418' />
                    
                  </td>
              </tr>


                  <tr v-if="$page.props.userPermissions.includes('list.companies')">
                  <td class='p-2 whitespace-nowrap'>
                    <div class='flex items-center'>
                    <div class='font-medium text-gray-800'>Empresas</div>
                    </div>
                  </td>
                  <td class='p-2 text-center'>
                    <Checkbox @click='markLine(range(6, 10), 2)' v-model='lineChecked' class='ml-auto' :value='2' />
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='6' />
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='7' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='8' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='9' />
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='10' />
                    
                  </td>
                  </tr>

                  <tr>
                    <td class="p-2 whitespace-nowrap">
                      <div class="flex items-center">
                        <div class="font-medium text-gray-800">Gestão de Usuários</div>
                      </div>
                    </td>
                    <td class="p-2 text-center">
                      <Checkbox @click="markLine(range(1, 5), 1)" v-model="lineChecked" class="ml-auto" :value="1" />
                    </td>
                    <td class="p-2 whitespace-nowrap text-center">
                      <Checkbox v-model="checked" :value="1" class="ml-auto" />
                    </td>
                    <td class="p-2 whitespace-nowrap text-center">
                      <Checkbox v-model="checked" :value="2" class="ml-auto" />
                    </td>
                    <td class="p-2 whitespace-nowrap text-center">
                      <Checkbox v-model="checked" :value="3" class="ml-auto" />
                    </td>
                    <td class="p-2 whitespace-nowrap text-center">
						<Checkbox v-model="checked" :value="4" class="ml-auto" />
                    </td>
                    <td class="p-2 whitespace-nowrap text-center">
                      <Checkbox v-model="checked" :value="5" placeholder="Selecionar todas" class="ml-auto" />
                    </td>
                  </tr>
				  
				  <tr>
					<td class='p-2 whitespace-nowrap'>
					<div class='flex items-center'>
						<div class='font-medium text-gray-800'>Logs Usuários</div>
					</div>
					</td>
					<td class='p-2 text-center'>
					<Checkbox @click='markLine(range(21, 25), 5)' v-model='lineChecked' class='ml-auto' :value='5' />
					</td>
					<td class='p-2 whitespace-nowrap text-center'>
					<Checkbox v-model='checked' :value='21' />
					</td>
					<td class='p-2 whitespace-nowrap text-center'>
					<!-- <Checkbox v-model='checked' :value='22' /> -->-
					
					</td>
					<td class='p-2 whitespace-nowrap text-center'>
					<!-- <Checkbox v-model='checked' :value='23' /> -->-
					
					</td>
					<td class='p-2 whitespace-nowrap text-center'>
					<!-- <Checkbox v-model='checked' :value='24' /> -->-
					
					</td>
					<td class='p-2 whitespace-nowrap text-center'>
					<!-- <Checkbox v-model='checked' :value='25' /> -->-
					
					</td>
				</tr>

                  <tr>
                  <td class='p-2 whitespace-nowrap'>
                    <div class='flex items-center'>
                    <div class='font-medium text-gray-800'>Logs Erros</div>
                    </div>
                  </td>
                  <td class='p-2 text-center'>
                    <Checkbox @click='markLine(range(16, 20), 4)' v-model='lineChecked' class='ml-auto' :value='4' />
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <Checkbox v-model='checked' :value='16' />
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <!-- <Checkbox v-model='checked' :value='17' /> -->-
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <!-- <Checkbox v-model='checked' :value='18' /> -->-
                    
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
					<!-- <Checkbox v-model='checked' :value='19' /> -->-
                  </td>
                  <td class='p-2 whitespace-nowrap text-center'>
                  <!-- <Checkbox v-model='checked' :value='20' /> -->-
                    
                  </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import Checkbox from "primevue/checkbox";
import _ from "lodash";
import { ref, defineProps, watch, defineEmits } from "vue";

const props = defineProps({
  setChecked: Array,
});

const emit = defineEmits(["checked"]);

const selectedAll = ref(false);

function range(first, last) {
  return _.range(first, last + 1);
}

const checked = ref(props.setChecked || []);
const lineChecked = ref([]);

function markLine(Array, id) {
  if (!lineChecked?.value?.includes(id)) {
    Array.forEach(function (data) {
      if (checked?.value?.includes(data)) {
        return;
      }
      checked?.value?.push(data);
    });
  } else {
    Array.forEach(function (data) {
      checked?.value.remove(data);
    });
  }
}

function markAll(Array) {
  let lineChecked = range(1, 69);

  if (!selectedAll.value) {
    lineChecked?.value?.forEach(function (data) {
      lineChecked.value.push(data);
    });
    Array.forEach(function (data) {
      if (checked.value.includes(data)) {
        return;
      }
      checked.value.push(data);
    });
  } else {
    lineChecked?.value?.forEach(function (data) {
      lineChecked.value.remove(data);
    });
    Array.forEach(function (data) {
      checked.value.remove(data);
    });
  }
}

watch(checked, () => {
  emit("update:checked", checked.value);
});

watch(lineChecked, () => {
  emit("update:checked", checked.value);
});

watch(selectedAll, () => {
  emit("update:checked", checked.value);
});
</script>

<style>
</style>