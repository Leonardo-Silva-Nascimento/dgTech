<template>

  <div class="relative flex gap-3 justify-between bg-secundary">
    <SideBar
      class="hidden md:block w-[10%] 2xl:w-[10%] h-[128vh] overflow-x-scroll scroll-zap flex-grow bg-white shadow-md">
      <div class="bg-white w-full z-50 overflow-y-auto">
        <center>
          <img class="text-center" src="/images/logo_menu.png" alt="" srcset="" style="width:80%">
        </center>
        <nav class="mt-6 list-none px-5">



          <!-- <Link as="button" class="w-full hover:bg-primary hover:rounded-xl mt-1 " :href="route('list.ConfigCarros')" v-if="$page.props.userPermissions.includes('list.ConfigCarros')" >
          <li :class="currentRoute === 'listagem' ? 'bg-primary' : ''"
            class="flex flex-col py-5 justify-center rounded-xl w-full font-semibold items-center text-[14.5px]">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="w-5 h-5">
               <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 0 1-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 0 0 6.16-12.12A14.98 14.98 0 0 0 9.631 8.41m5.96 5.96a14.926 14.926 0 0 1-5.841 2.58m-.119-8.54a6 6 0 0 0-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 0 0-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 0 1-2.448-2.448 14.9 14.9 0 0 1 .06-.312m-2.24 2.39a4.493 4.493 0 0 0-1.757 4.306 4.493 4.493 0 0 0 4.306-1.758M16.5 9a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
            </svg>
            <span class="font-bold text-[16px] mt-[12px]" v-show="!toggleTextMenu">Carros</span>
          </li>
          </Link> -->
          <div class="uppercase mt-9 mb-4 text-[10px] font-bold tracking-widest text-gray-400/90">
            <span v-show="!toggleTextMenu">
              Dashboard's
            </span>
          </div>
          <Link as="button" :href="route('list.Dashboard')" class="w-full mb-2">
          <li
            class="flex items-center gap-3 rounded-2xl py-[10px] px-[14px] w-full font-semibold text-[14px] background_opacity hover:bg-gradient-to-r from-primary to-[#000000] hover:text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
              class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h18v18H3z" />
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 9h6v6H9z" />
            </svg>

            <span>Dashboard</span>
          </li>
          </Link>


          <div class="uppercase mt-9 mb-4 text-[10px] font-bold tracking-widest text-gray-400/90">
            <span v-show="!toggleTextMenu">
              Configurações
            </span>
          </div>


          <Link as="button" :href="route('list.users')" class="w-full mb-2">
          <li
            class="flex items-center gap-3 rounded-2xl py-[10px] px-[14px] w-full font-semibold text-[14px] background_opacity hover:bg-gradient-to-r from-primary to-secundary hover:text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M16 14c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z" />
              <path stroke-linecap="round" stroke-linejoin="round" d="M8 8c-2.21 0-4 1.79-4 4s1.79 4 4 4" />
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M5.5 20c1.83-1.11 4.01-1.11 5.84 0M12 8c-3.31 0-6 2.69-6 6v2.5" />
            </svg>
            <span>Usuarios</span>
          </li>
          </Link>


        </nav>
      </div>
    </SideBar>
    <div class=" w-[100%] md:w-[80%] 2xl:w-[80%]">
      

      <div class="p-[12px] md:h-[128vh] overflow-y-scroll scroll-zap">
        <slot />
      </div>
    </div>
    <SideBarRight class="w-[20%] hidden md:inline shadow-md 2xl:w-[15%] bg-white">
      <div class="bg-white w-full z-50 overflow-y-auto">
        <nav class="mt-6 list-none px-5">
          <div class="flex items-center justify-center">
            <div class="border-[4px] rounded-full border-primary overflow-hidden relative">
              <div class="border-[10px] rounded-full border-primary">
                <img class="rounded-full h-[80px] w-[80px] object-cover z-50" :src="$page.props.user?.profile_picture"
                  onerror="this.src='/images/profile_default.png';" />
              </div>
            </div>
          </div>
          <div class="flex flex-col mt-4 text-center">
            <h1 class="font-semibold text-[14px] mb-1 text-[#000000]">{{ $page.props.user?.name }}</h1>
            <p class="font-semibold text-[14px] text-[#858585]">UX/UI Designer</p>
          </div>
          <div class="mt-[24px]">
            <h1 class="text-[20px] font-bold">Navegação</h1>
            <p class="font-bold text-[14px] text-[#858585]">Acesse as páginas para seu perfil</p>
          </div>
          <ul class="mt-[20px] flex flex-col gap-y-4">
            <Link as="button" :href="route('form.update.profile')">
            <li>

              <a class="px-3 py-5 bg-secundary flex items-center justify-between rounded-xl" href="#">
                <div class="flex gap-3 items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="w-6 h-6 text-primary">
                    <path fill-rule="evenodd"
                      d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                      clip-rule="evenodd" />
                  </svg>
                  <div>
                    <span class="font-bold text-[18px]">Meus dados</span>
                  </div>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                  <path fill-rule="evenodd"
                    d="M16.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z"
                    clip-rule="evenodd" />
                </svg>
              </a>

            </li>
            </Link>

            <li>
              <Link class="px-3 py-5 bg-secundary flex items-center justify-between rounded-xl" href="/logout"
                method="post">
              <div class="flex gap-3 items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                  class="w-6 h-6 text-primary">
                  <path
                    d="M11.47 1.72a.75.75 0 0 1 1.06 0l3 3a.75.75 0 0 1-1.06 1.06l-1.72-1.72V7.5h-1.5V4.06L9.53 5.78a.75.75 0 0 1-1.06-1.06l3-3ZM11.25 7.5V15a.75.75 0 0 0 1.5 0V7.5h3.75a3 3 0 0 1 3 3v9a3 3 0 0 1-3 3h-9a3 3 0 0 1-3-3v-9a3 3 0 0 1 3-3h3.75Z" />
                </svg>
                <div>
                  <span class="font-bold text-[18px]">Sair da conta</span>
                </div>
              </div>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path fill-rule="evenodd"
                  d="M16.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z"
                  clip-rule="evenodd" />
              </svg>
              </Link>
            </li>
          </ul>
        </nav>
      </div>
    </SideBarRight>
  </div>
</template>

<script setup>
import { ref, watch } from "vue";
import SlideUpDown from "vue3-slide-up-down";

const dropLogs = ref(false);
const dropRight = ref(false);
const dropLeft = ref(false);

const dropdownConfig = ref(false);
const dropdownConfigConf = ref(false);

const dropdownAudit = ref(false);
const dropdownAuditConf = ref(false);

const dropdownReports = ref(false);
const dropdownReportsConf = ref(false);

const dropdownFinanceiro = ref(false);
const dropdownFinanceiroConf = ref(false);

const dropdownMotorista = ref(false);
const dropdownMotoristaConf = ref(false);

const currentRoute = ref("dashboard");

const changeRoute = (routName) => {
  currentRoute.value = routName;
}

const toggleMenu = ref(false);
const toggleTextMenu = ref(false);

const toggleMenuMobile = ref(true);

watch(toggleMenu, () => {
  if (!toggleMenu.value) {
    setTimeout(() => {
      toggleTextMenu.value = toggleMenu.value;
    }, 150);
    return;
  }
  toggleTextMenu.value = toggleMenu.value;
});
</script>


<style scoped>
/* Firefox */
* {
  scrollbar-width: auto;
  scrollbar-color: #d1d1d1 #ffffff;
}

/* Chrome, Edge, and Safari */
*::-webkit-scrollbar {
  width: 12px;
}

/* Chrome, Edge, and Safari */

*::-webkit-scrollbar-track {
  background: #ffffff;
}

*::-webkit-scrollbar-thumb {
  background-color: #d1d1d1;
  border-radius: 10px;
  border: 3px solid #ffffff;
}
</style>
