<template>
	<div class="items-center justify-center w-full">
		<div class="flex items-center justify-between">
			<div class="flex flex-col">
				<span class="font-semibold text-[14px] text-[#858585] mb-0">Bem-vind de volta, {{ $page.props.userName
					}}!</span>
				<h1 class="font-bold text-[20px] mb-0">Dashboard</h1>
			</div>
		</div>
		<div class="md:flex gap-4 mt-[24px]">

			<div class="flex-grow flex justify-between items-center py-4 mb-2 px-[32px] bg-white rounded-xl">
				<div class="flex flex-col">

					<span class="text-[14px] text-[#858585]">Criados esta semana</span>
					<strong class="text-[24px] font-bold">{{ $page.props.totalSemanal }} </strong>
				</div>
				<div class="flex gap-x-3">

					<div class="bg-gray-300/90 w-[9px] rounded-2xl h-[60px] flex items-end">
						<span class="w-full h-[80%] rounded-2xl bg-primary"></span>
					</div>

					<div class="bg-gray-300/90 w-[9px] rounded-2xl h-[60px] flex items-end">
						<span class="w-full h-[30%] rounded-2xl bg-primary"></span>
					</div>

					<div class="bg-gray-300/90 w-[9px] rounded-2xl h-[60px] flex items-end">
						<span class="w-full h-[70%] rounded-2xl bg-primary"></span>
					</div>

					<div class="bg-gray-300/90 w-[9px] rounded-2xl h-[60px] flex items-end">
						<span class="w-full h-[90%] rounded-2xl bg-primary"></span>
					</div>

					<div class="bg-gray-300/90 w-[9px] rounded-2xl h-[60px] flex items-end">
						<span class="w-full h-[15%] rounded-2xl bg-primary"></span>
					</div>
				</div>
			</div>

			<div class="flex items-center gap-3 bg-white  py-4  mb-2 px-[32px] rounded-xl">
				<div class="w-[56px] h-[56px] flex items-center justify-center bg-[#F4F7FE] rounded-full">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
						class="w-6 h-6 text-primary">
						<path
							d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.036-.84-1.875-1.875-1.875h-.75ZM9.75 8.625c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-.75a1.875 1.875 0 0 1-1.875-1.875V8.625ZM3 13.125c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v6.75c0 1.035-.84 1.875-1.875 1.875h-.75A1.875 1.875 0 0 1 3 19.875v-6.75Z" />
					</svg>
				</div>

				<div class="flex flex-col">
					<span class="text-[14px] text-[#858585]">Total de usuarios</span>
					<strong class="text-[24px] font-bold">{{ $page.props.totalUser }}</strong>
				</div>
			</div>

			<div class="flex items-center gap-3 bg-white  py-4  mb-2 px-[32px] rounded-xl">
				<div class="w-[56px] h-[56px] flex items-center justify-center bg-[#F4F7FE] rounded-full">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
						class="w-6 h-6 text-primary">
						<path
							d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.036-.84-1.875-1.875-1.875h-.75ZM9.75 8.625c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-.75a1.875 1.875 0 0 1-1.875-1.875V8.625ZM3 13.125c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v6.75c0 1.035-.84 1.875-1.875 1.875h-.75A1.875 1.875 0 0 1 3 19.875v-6.75Z" />
					</svg>
				</div>

				<div class="flex flex-col">
					<span class="text-[14px] text-[#858585]">Usuarios Ativos</span>
					<strong class="text-[24px] font-bold">{{ $page.props.totalUserAtivo }}</strong>
				</div>
			</div>

			<div class="flex items-center gap-3 bg-white  py-4  mb-2 px-[32px] rounded-xl">
				<div class="w-[56px] h-[56px] flex items-center justify-center bg-[#F4F7FE] rounded-full">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
						class="w-6 h-6 text-primary">
						<path
							d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.036-.84-1.875-1.875-1.875h-.75ZM9.75 8.625c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-.75a1.875 1.875 0 0 1-1.875-1.875V8.625ZM3 13.125c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v6.75c0 1.035-.84 1.875-1.875 1.875h-.75A1.875 1.875 0 0 1 3 19.875v-6.75Z" />
					</svg>
				</div>

				<div class="flex flex-col">
					<span class="text-[14px] text-[#858585]">Usuarios inativos</span>
					<strong class="text-[24px] font-bold">{{ $page.props.totalUserInativos }}</strong>
				</div>
			</div>


		</div>

	</div>

	<!-- Chart -->
	<div class="flex items-center justify-between gap-3">
		<div class="flex-grow ">



			<div class="border-b-2 border-gray-300/90">
				<h1 class="mb-0 text-[18px] font-bold">Total de usuarios por mês</h1>
			</div>
			<Chart :chart-data="chartData" :chart-options="chartOptions" type="bar" />
		</div>
	</div>


</template>


<script setup>
import Chart from "../../Components/Chart.vue";
import { defineProps } from "vue";
import { useToast } from "vue-toastification";
const _ = require("lodash");

const props = defineProps({
	AlertaError: Object,

	totalUser: Number,
	totalUserAtivo: Number,
	totalUserInativos: Number,
	

	totalSemanal: Number,

	labels: Array,
	dashAtivos: Array,
	dashInativos: Array,
});

const AlertaError = props.AlertaError;

const chartData = {
	labels: props.labels,
	datasets: [{
		label: 'Ativos',
		data: props.dashAtivos,
		backgroundColor: '#4CAF50' // Verde suave
	}, {
		label: 'Inativos',
		data: props.dashInativos,
		backgroundColor: '#FF9800' // Laranja vibrante
	}]
}


const chartOptions = {
	responsive: false,
	scales: {
		y: {
			beginAtZero: true
		}
	}
}

const toast = useToast();

ExibiAlertas();

function ExibiAlertas() {
	if (AlertaError == 1) {
		toast.error('Atenção! Usuário não autorizado.');
		console.log('1');
	}
}


</script>
