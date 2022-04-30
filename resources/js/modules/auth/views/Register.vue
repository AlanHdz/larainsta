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
          v-model="registerForm.email"
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
          v-model="registerForm.name"
          name="name"
          type="text"
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
          for="name"
          class="
            absolute
            transition-all
            left-2
            top-0
            text-gray-400 text-xxs
            peer-placeholder-shown:text-xs peer-placeholder-shown:top-2
            pointer-events-none
          "
          >Nombre</label
        >
      </div>
      <div class="relative">
        <input
          v-model="registerForm.username"
          name="username"
          type="text"
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
          for="username"
          class="
            absolute
            transition-all
            left-2
            top-0
            text-gray-400 text-xxs
            peer-placeholder-shown:text-xs peer-placeholder-shown:top-2
            pointer-events-none
          "
          >Nombre de usuario</label
        >
      </div>
      <div class="relative">
        <input
          v-model="registerForm.password"
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
      <div class="relative">
        <input
          v-model="registerForm.password_confirmation"
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
          for="password_confirmation"
          class="
            absolute
            transition-all
            left-2
            top-0
            text-gray-400 text-xxs
            peer-placeholder-shown:text-xs peer-placeholder-shown:top-2
            pointer-events-none
          "
          >Confirmar Contraseña</label
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
        Registrarse
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
    <span v-if="errors.confirm_password" class="mt-4 text-xs text-red-500">
      {{ errors.confirm_password }}
    </span>
    <span v-if="errors.username" class="mt-4 text-xs text-red-500">
      {{ errors.username }}
    </span>
    <span v-if="errors.name" class="mt-4 text-xs text-red-500">
      {{ errors.name }}
    </span>
    <span v-if="errors.email" class="mt-4 text-xs text-red-500">
      {{ errors.email }}
    </span>
  </div>
  <div class="bg-white w-80 border border-gray-300 text-center py-4">
    <span class="text-sm mr-2">Ya tienes una cuenta?</span>
    <router-link to="/" class="text-blue-500 text-sm font-semibold">Inicia sesión</router-link>
  </div>
</template>

<script>
import { ref, computed } from "vue";
import useAuth from '../composables/useAuth';
import { useRouter } from 'vue-router'
export default {
  setup() {

    const router = useRouter()
    const { createUser } = useAuth()
    const showPassword = ref(false);

    const errors = ref({
      'password': null,
      'username': null,
      'password_confirmation': null,
      'name': null,
      'email': null
    })

    const registerForm = ref({
      email: "",
      password: "",
      password_confirmation: "",
      username: "",
      name: ""
    });

    const togglePassword = () => {
      showPassword.value = !showPassword.value;
    };

    const isSubmitDisable = computed(() => {
      return (
        registerForm.value.email.length > 0 && registerForm.value.password.length > 0 && registerForm.value.username.length > 0
      );
    });

    return {
      registerForm,
      showPassword,
      togglePassword,
      isSubmitDisable,
      onSubmit: async () => {
        const { ok, message } = await createUser(registerForm.value);
        if (!ok) {
          errors.value['password'] = message['password'] ? message['password'][0] : null
          errors.value['password_confirmation'] = message['password_confirmation'] ?  message['password_confirmation'][0] : null
          errors.value['name'] = message['name'] ? message['name'][0] : null
          errors.value['email'] = message['email'] ? message['email'][0] : null
          errors.value['username'] =  message['username'][0] ? message['username'][0] : null
        } else {
          router.push({ name: 'home' })
        }
      },
      errors
    };
  },
};
</script>