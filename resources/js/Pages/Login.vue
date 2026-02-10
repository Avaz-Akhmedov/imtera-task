<template>
    <div class="min-h-screen flex items-center justify-center bg-gray-50">
        <div class="w-full max-w-md bg-white shadow-md rounded-2xl p-8">

            <h2 class="text-2xl font-bold text-center text-gray-900 mb-6">
                Вход в аккаунт
            </h2>

            <form @submit.prevent="submit">

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                        Электронная почта
                    </label>
                    <input
                        v-model="email"
                        id="email"
                        type="email"
                        class="w-full border rounded-lg px-3 py-2 outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                        placeholder="example@gmail.com"
                    />
                    <p v-if="errors.email" class="text-red-600 text-sm mt-1">{{ errors.email }}</p>
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                        Пароль
                    </label>
                    <input
                        v-model="password"
                        id="password"
                        type="password"
                        class="w-full border rounded-lg px-3 py-2 outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                        placeholder="••••••••"
                    />
                    <p v-if="errors.password" class="text-red-600 text-sm mt-1">{{ errors.password }}</p>
                </div>

                <button
                    type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg text-md font-semibold hover:bg-blue-700 transition"
                >
                    Войти
                </button>

                <p v-if="errors.global" class="text-red-600 text-center text-sm mt-4">
                    {{ errors.global }}
                </p>
            </form>

        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import axios from "axios";


const email = ref("");
const password = ref("");

const errors = ref({
    email: null,
    password: null,
    global: null
});

const submit = async () => {
    errors.value = { email: null, password: null, global: null };

    try {
        await axios.post("/login", {
            email: email.value,
            password: password.value
        }, {
            withCredentials: true
        });

        window.location.href = "/settings"

    } catch (error) {
        if (error.response?.status === 422) {
            const val = error.response.data.errors;
            errors.value.email = val?.email?.[0] || null;
            errors.value.password = val?.password?.[0] || null;
        }
        else if (error.response?.status === 401) {
            errors.value.global = "Неверный email или пароль";
        }
        else {
            errors.value.global = "Произошла ошибка. Попробуйте позже.";
        }
}
}
</script>
