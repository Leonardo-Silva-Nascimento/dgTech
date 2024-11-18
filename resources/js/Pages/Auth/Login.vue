<template>
  <form @submit.prevent="submit">
    <div class="py-[20px] relative h-[120.vh] body-background">
      <div class="fixed w-full flex items-center justify-center ">
        <div class="bg-white rounded-xl my-4 h-[100vh] p-5 px-[80px] flex flex-col justify-center item-center w-[523px] border">
          <div class="flex items-center justify-center mb-[56px]">
            <img src="images/logo_completa.png" class="w-[400px]" />
          </div>

          <div class="flex flex-col mb-[32px]">
            <label class="font-[400] text-[16px] text-[#858585]">Digite seu e-mail</label>
            <input type="text"
              class="px-3 py-2 bg-gray-200/90 rounded-xl font-semibold text-[16px] text-primary outline-none border-0"
              v-model="form.email" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" required />
          </div>
          <div class="flex flex-col">
            <label class="font-[400] text-[16px] text-[#858585]">Digite sua senha</label>
            <input type="password"
              class="px-3 py-2 bg-gray-200/90 font-semibold text-[16px] text-primary rounded-xl outline-none border-0"
              v-model="form.password" :feedback="false" toggleMask autocomplete="off" readonly
              onfocus="this.removeAttribute('readonly');" required />
            <p class="text-[#1f81a6] mt-[8px]">Esqueceu sua senha?</p>
          </div>
          <button type="submit"
            class="my-[32px] flex items-center gap-3 w-full bg-primary text-white rounded-xl py-3 justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
              <path
                d="M3.478 2.404a.75.75 0 0 0-.926.941l2.432 7.905H13.5a.75.75 0 0 1 0 1.5H4.984l-2.432 7.905a.75.75 0 0 0 .926.94 60.519 60.519 0 0 0 18.445-8.986.75.75 0 0 0 0-1.218A60.517 60.517 0 0 0 3.478 2.404Z" />
            </svg>
            <span class="font-bold text-[16px] text-white">Entrar</span>
        </button>
        </div>
      </div>
    </div>
  </form>
</template>





<script>
import Layout from "../../Layouts/Auth.vue";
export default {
  layout: [Layout],
};
</script>

<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { useToast } from "vue-toastification";
import { ref, onUnmounted } from "vue";
import InputText from "primevue/inputtext";
import Password from "primevue/password";


const toast = useToast();
const sending = ref(false);
const error = ref(false);

const form = useForm({
  email: "",
  password: "",
});

function submit() {
  sending.value = true;
  if (form.email && form.password) {

    form.post(route("action.login"), {
      onSuccess: () => (window.location.href = "/index"),
      onFinish: () => (sending.value = false),
    });
  } else {
    sending.value = false
  }
}

onUnmounted(() => {
  let body = document.querySelector(".body-background");
  body.classList.remove(".body-background");
});
</script>

<style>
.body-background {
  background-image: url("/images/background.jpg");
  background-repeat: no-repeat;
  background-size: 100% 100% 100% 100%;
  background-size: cover;
  background-attachment: fixed;
  background-position: center;
  height: 163.5vh;
}

body {
  margin: 0;
  padding: 0;
}
</style>
