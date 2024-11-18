<template>
    <div class="h-[122vh]">

        <p><br /></p>
        <AchievementCard :Registros="props.Registros" :RotaCadastro="route('form.store.user')"
            :RotaExcel="route('get.Excel.users')" />

        <div class="mt-4 flex flex-col max-md:px-2 py-1 rounded-lg shadow-sm ">
            <div>
                <div class="overflow-hidden overflow-x-visible min-h-[80vh]">

                    <div class="w-full  bg-white p-4 flex items-center justify-between rounded-t-2xl">

                        <h1 class="font-semibold text-[18px]">Contatos</h1>
                        <div class="flex items-center gap-3">
                            <div class="flex">

                                <button
                                    class="border-2 border-gray-200/90 rounded-2xl p-2 flex items-center justify-center gap-2 "
                                    @click="showFitlerAvancado">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-6 h-6">
                                        <path
                                            d="M18.75 12.75h1.5a.75.75 0 0 0 0-1.5h-1.5a.75.75 0 0 0 0 1.5ZM12 6a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 12 6ZM12 18a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 12 18ZM3.75 6.75h1.5a.75.75 0 1 0 0-1.5h-1.5a.75.75 0 0 0 0 1.5ZM5.25 18.75h-1.5a.75.75 0 0 1 0-1.5h1.5a.75.75 0 0 1 0 1.5ZM3 12a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 3 12ZM9 3.75a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5ZM12.75 12a2.25 2.25 0 1 1 4.5 0 2.25 2.25 0 0 1-4.5 0ZM9 15.75a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5Z" />
                                    </svg>
                                    <span class="text-[14px]">Filtros Avançados</span>
                                </button>

                                <div class="absolute w-[400px] mt-12 mr-[240px] rounded-xl p-3 bg-white shadow-xl"
                                    v-if="hasFilterVancado">
                                    <h1 class="border-b-2 border-gray-300/90 ">Filtros Avançados</h1>
                                    <div class="my-4 flex flex-col gap-y-3">
                                        <form @submit.prevent="submit">
                                            <div class="flex ml-4 mr-4 grid grid-cols-1 gap-8 max-md:grid-cols-1">

                                                <div>
                                                    <span class="p-float-label">
                                                        <InputText v-model="form2.nome" id="nome" type="text"
                                                            class="w-full" />
                                                        <label for="nome" class="text-sm">Nome</label>
                                                    </span>
                                                </div>

                                                <div>
                                                    <span class="p-float-label">
                                                        <InputText v-model="form2.hierarquia" id="hierarquia"
                                                            type="text" class="w-full" />
                                                        <label for="hierarquia" class="text-sm">Hierarquia</label>
                                                    </span>
                                                </div>

                                                <div>
                                                    <span class="p-float-label">
                                                        <InputText v-maska="'##/##/####'" v-model="form2.created_at"
                                                            id="created_at" type="text" class="w-full" />
                                                        <label for="created_at" class="text-sm">Data de criação</label>
                                                    </span>
                                                </div>

                                                <div>
                                                    <span class="p-float-label">
                                                        <Dropdown class="w-full" v-model="form2.status"
                                                            :options="statusOption" optionLabel="name"
                                                            dataKey="value" />
                                                        <label for="status" class="text-sm">Status</label>
                                                    </span>
                                                </div>


                                                <div class="custom-checkbox">
                                                    <input type="checkbox" id="binary" v-model="form2.limparFiltros" />
                                                    <label for="binary" class="custom-label">Deseja Resetar o Filtro
                                                        Aplicado?</label>
                                                </div>

                                            </div>
                                            <div class="flex ml-4 space-x-5 mt-8">
                                                <button @click="FiltroAvancadoAplica"
                                                    class="p-2 flex rounded-md bg-primary text-white px-6 text-sm font-medium items-center">
                                                    Aplicar
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class=" mb-24">

                            <tr class="text-gray-500 font-bold select-none" @click="setParams">

                                <th scope="col"
                                    class="px-4 text-center text-sm cursor-pointer items-center border-r group"
                                    @click="orderBy = { column: 'name', sorting: sortTable(sortVal.name) ? sortVal.name = 1 : sortVal.name = 0 }">
                                    <div class="flex">
                                        <span class="group-hover:text-indigo-800">Nome</span>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5 ml-auto group-hover:text-indigo-800" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                                        </svg>
                                    </div>
                                </th>

                                <th scope="col"
                                    class="px-4 text-center text-sm cursor-pointer items-center border-r group">
                                    <div class="flex">
                                        <span class="group-hover:text-indigo-800">Hierarquia</span>

                                    </div>
                                </th>

                                <th v-if="formColumns.columns.status" scope="col"
                                    class="px-4 text-sm cursor-pointer text-left border-r group"
                                    @click="orderBy = { column: 'status', sorting: sortTable(sortVal.status) ? sortVal.status = 1 : sortVal.status = 0 }">
                                    <div class="flex">
                                        <span class="group-hover:text-indigo-800">Status</span>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5 ml-auto group-hover:text-indigo-800" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                                        </svg>
                                    </div>
                                </th>

                                <th v-if="formColumns.columns.created_at" scope="col"
                                    class="px-4 text-center text-sm cursor-pointer items-center border-r group"
                                    @click="orderBy = { column: 'created_at', sorting: sortTable(sortVal.created_at) ? sortVal.created_at = 1 : sortVal.created_at = 0 }">
                                    <div class="flex">
                                        <span class="group-hover:text-indigo-800">Data de Cadastro</span>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5 ml-auto group-hover:text-indigo-800" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                                        </svg>
                                    </div>
                                </th>

                                <th scope="col" class="px-3 py-3.5 text-right text-sm sm:pr-12">Ações</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 bg-white">
                            <tr v-for="(data, key) in dataTable" :key="key" class="hover:bg-indigo-50/20"
                                :class="{ 'bg-gray-50': (key % 2) }">

                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 flex-shrink-0" v-if="data?.profile_picture">
                                            <img class="h-10 w-10 rounded-full" :src="data?.profile_picture"
                                                onerror="javascript: this.src = '/images/profile_default.png'" alt="" />
                                        </div>
                                        <div class="h-10 w-10 flex-shrink-0" v-if="!data?.profile_picture">
                                            <img class="h-10 w-10 rounded-full" src="/images/profile_default.png"
                                                alt="" />
                                        </div>
                                        <div class="ml-4">
                                            <div class="font-medium text-gray-900">{{ data?.name }}</div>
                                            <div class="text-gray-500">{{ data?.email }}</div>
                                        </div>
                                    </div>
                                </td>

                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 text-center">
                                    {{ data.customizada || 'Sem observação' }}
                                </td>

                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 text-center">
                                    <span v-if="data.status == 1" class="text-green-500">Ativo</span>
                                    <span v-else class="text-red-500">Inativo</span>
                                </td>

                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 text-center">
                                    {{ data.created_at }}
                                </td>

                                <td class="whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    <Actions :routeDel="route('form.delete.user', { id: data?.id })"
                                        :routeUpdate="route('form.update.user', { id: data?.id })" />
                                </td>

                            </tr>
                        </tbody>

                    </table>

                    <Pagination :links="dataTable" />
                </div>
            </div>
        </div>
    </div>
</template>


<script setup>
import Checkbox from "primevue/checkbox";
import Dropdown from "primevue/dropdown";
import InputText from "primevue/inputtext";
import Pagination from "../Pagination2.vue";
import AchievementCard from "../../Layouts/CardsListagens.vue";
import Actions from "./Actions.vue";
import { ref, defineProps, watch } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
const _ = require("lodash");

const props = defineProps({
    dataTable: Object,
    Registros: Object, Filtros: Object,
});
const FiltroAvancado = ref(false);
const hasFilterVancado = ref(false);
const showFitlerAvancado = () => {
    hasFilterVancado.value = !hasFilterVancado.value;
}
const statusOption = [
    { name: "Ativo", value: 1 },
    { name: "Inativo", value: 0 },
];


const searchBy = ref(getParams("searchBy") || "");
const statusValue = ref(getParams("byStatus"));
const recordValue = ref(getParams("limit") || 10);
const orderBy = ref(["column", "sorting"]);
const toggleFilter = ref(false);

const sortVal = {
    name: 1,
    hierarch: 1,
    status: 1,
    created_at: 1,
};

const formColumns = useForm({
    route_of_list: "list.users",
    columns: {
        name: validateColumnsVisibility("name"),
        hierarchy: validateColumnsVisibility("hierarchy"),
        status: validateColumnsVisibility("status"),
        created_at: validateColumnsVisibility("created_at"),
    },
});

function validateColumnsVisibility(column) {
    let columnValue = Inertia.page.props.columnsTable?.[column];
    if (typeof columnValue == "boolean") {
        return columnValue;
    }
    return true;
}

function sortTable(sort) {
    if (sort) {
        return 0;
    } else {
        return 1;
    }
}

function hasFilterActived() {
    if (
        getParams("searchBy") !== null ||
        getParams("limit") !== null ||
        getParams("orderBy") !== null
    ) {
        return true;
    }
    return false;
}

function resetFilter() {
    window.history.replaceState(null, null, window.location.pathname);
    recordValue.value = 10;
    searchBy.value = "";
    Inertia.reload();
}

function setParams() {
    let data = {
        limit: recordValue?.value,
        searchBy: searchBy.value,
        byStatus: statusValue?.value?.value,
    };

    !orderBy.value?.length ? (data.orderBy = orderBy?.value) : "";

    Inertia.visit("", {
        preserveState: true,
        replace: false,
        data,
    });
}

const form2 = useForm({
    nome: props.Filtros?.nome || null,
    hierarquia: props.Filtros?.Hierarquia || null,
    status: props.Filtros?.status || null,
    created_at: props.Filtros?.created_at || null,
    limparFiltros: "",
});

function getFormFiltered() {
    const newForm = {};
    for (let [key, value] of Object.entries(form2)) {
        if (typeof value == "object" && value?.value) {
            newForm[key] = value.value;
        } else {
            newForm[key] = value;
        }
    }
    return newForm;
}

function FiltroAvancadoAplica() {
    const submitForm = getFormFiltered();
    let data = {
        submitForm,
    };
    !orderBy.value?.length ? (data.orderBy = orderBy?.value) : "";
    submitForm.post(route("listP.users"), {
        replace: false,
        data,
        onSuccess: () => {
            (FiltroAvancado.value = false); // recarrega a página após a atualização
        },
    });
}


</script>
<style scoped>
input,
.p-float-label input,
.p-float-label select,
.p-float-label .p-dropdown,
.p-float-label .p-multiselect {
    border-radius: 8px;
    border: 1px solid #ccc;
    padding: 0.5rem;
    width: 100%;
    box-sizing: border-box;
}

.p-dropdown,
.p-multiselect {
    border-radius: 8px;
    border: 1px solid #ccc;
}

input:focus,
.p-dropdown:focus,
.p-multiselect:focus {
    outline: none;
    border-color: #4A90E2;
    box-shadow: 0 0 5px rgba(74, 144, 226, 0.5);
}

button,
.p-button {
    border-radius: 8px;
}

/* Estilo para garantir que o texto não seja cortado */
.p-multiselect-label-container,
.p-multiselect,
.p-dropdown,
.p-float-label .p-inputtext,
.p-float-label .p-password-input {
    line-height: 0.2;
    /* Ajusta a altura da linha */
    overflow: visible;
    /* Garante que o conteúdo não seja cortado */
}

/* Ajuste específico para o MultiSelect para evitar corte */
.p-multiselect-label-container {
    display: flex;
    align-items: center;
    /* Centraliza o texto verticalmente */
    height: 50%;
    /* Ajusta a altura */
}

.custom-checkbox {
    display: flex;
    align-items: center;
    margin: 10px 0;
}

/* Apenas estiliza as bordas do checkbox */
.custom-checkbox input[type="checkbox"] {
    border: 2px solid #1f81a6;
    /* Cor da borda */
    outline: none;
    /* Remove o contorno padrão */
    border-radius: 4px;
    /* Bordas arredondadas (opcional) */
    margin: 0;
    /* Remove margens padrão */
    width: 20px;
    /* Ajusta a largura da caixinha */
    height: 20px;
    /* Ajusta a altura da caixinha */
}

/* Opcional: Estilo quando marcado */
.custom-checkbox input[type="checkbox"]:checked {
    background-color: #1f81a6;
    /* Cor de fundo quando selecionado */
    border-color: #1f81a6;
    /* Cor da borda quando selecionado */
}

.custom-label {
    margin-left: 10px;
    /* Margem do rótulo em relação ao checkbox */
    font-size: 14px;
    /* Tamanho da fonte do rótulo */
}
</style>