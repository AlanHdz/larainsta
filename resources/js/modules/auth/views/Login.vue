<template>
  <div
    class="
      bg-white
      mb-3
      border border-gray-300
      w-80
      pt-8
      pb-4
      flex flex-col
      items-center
    "
  >
    <h1 class="instagram-logo"></h1>
    <form @submit.prevent="onSubmit" class="w-64 flex flex-col gap-1 mt-8">
      <div class="relative">
        <input
          v-model="loginForm.email"
          name="email"
          type="email"
          class="
            focus:outline-blue-400
            peer
            w-full
            rounded
            border
            bg-gray-100
            p-2
            text-xs
            placeholder-transparent
          "
          placeholder="Correo electronico"
        />
        <label
          for="email"
          class="
            absolute
            transition-all
            left-2
            top-0
            text-gray-400 text-xxs
            peer-placeholder-shown:text-xs peer-placeholder-shown:top-2
            pointer-events-none
          "
          >Correo electronico</label
        >
      </div>
      <div class="relative">
        <input
          v-model="loginForm.password"
          name="password"
          :type="showPassword ? 'text' : 'password'"
          class="
            focus:outline-blue-400
            peer
            w-full
            rounded
            border
            bg-gray-100
            p-2
            text-xs
            placeholder-transparent
          "
          placeholder="Contraseña"
        />
        <label
          for="password"
          class="
            absolute
            transition-all
            left-2
            top-0
            text-gray-400 text-xxs
            peer-placeholder-shown:text-xs peer-placeholder-shown:top-2
            pointer-events-none
          "
          >Contraseña</label
        >
        <button
          @click.prevent="togglePassword"
          class="
            absolute
            right-2
            bottom-2
            focus:text-gray-500
            rounded
            text-sm
            font-semibold
          "
        >
          {{ showPassword ? "Hide" : "Show" }}
        </button>
      </div>
      <button
        type="submit"
        :disabled="!isSubmitDisable"
        :class="!isSubmitDisable ? 'bg-blue-300' : 'bg-blue-500'"
        class="mt-2 text-sm text-center text-white py-1 rounded font-medium"
      >
        Iniciar Sesión
      </button>
    </form>
    <div class="flex space-x-2 w-64 mt-4 items-center">
      <span class="bg-gray-300 h-px flex-1"></span>
      <span class="p-2 uppercase text-xs text-gray-400 font-semibold">o</span>
      <span class="bg-gray-300 h-px flex-1"></span>
    </div>
    <button class="mt-4 flex">
      <div class="bg-no-repeat facebook-logo mr-1"></div>
      <span class="text-xs text-blue-900 font-semibold"
        >Iniciar sesión con Facebook</span
      >
    </button>
    <span v-if="errors.password" class="mt-4 text-xs text-red-500">
      {{ errors.password }}
    </span>
    <span v-if="errors.email" class="mt-4 text-xs text-red-500">
      {{ errors.email }}
    </span>
  </div>
  <div class="bg-white w-80 border border-gray-300 text-center py-4">
    <span class="text-sm mr-2">No tienes una cuenta?</span>
    <router-link to="/register" class="text-blue-500 text-sm font-semibold">Registrate</router-link>
  </div>
</template>

<script>
import { ref, computed } from "vue";
import useAuth from '../composables/useAuth'
import { useRouter } from 'vue-router'
export default {
  setup() {

    const router = useRouter()
    const { loginUser } = useAuth()

    const showPassword = ref(false);
    
    const errors = ref({
      'password': null,
      'email': null
    })

    const loginForm = ref({
      email: "",
      password: "",
    });

    const togglePassword = () => {
      showPassword.value = !showPassword.value;
    };

    const isSubmitDisable = computed(() => {
      return (
        loginForm.value.email.length > 0 && loginForm.value.password.length > 0
      );
    });

    return {
      loginForm,
      showPassword,
      togglePassword,
      isSubmitDisable,
      errors,
      onSubmit: async () => {
        const { ok, message } = await loginUser(loginForm.value);
        if (!ok) {
          errors.value['password'] =  message['password'] ? message['password'][0] : null
          errors.value['email'] = message['email'] ? message['email'][0] : null
        } else {
          router.push({ name: 'home' })
        }
      }
    };
  },
};
</script>