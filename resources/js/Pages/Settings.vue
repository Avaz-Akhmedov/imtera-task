<template>
    <div class="flex min-h-screen bg-gray-50">
        <DashboardLayout></DashboardLayout>

        <main class="flex-1 flex flex-col overflow-auto">
            <header class="bg-white border-b border-gray-200 px-6 py-4 flex justify-between items-center">
                <h1 class="text-lg font-semibold text-gray-800">Подключить Яндекс</h1>
                <Link
                    as="button"
                    method="post"
                    href="/logout"
                    class="flex items-center px-3 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                         fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M3 4a1 1 0 011-1h6a1 1 0 110 2H5v10h5a1 1 0 110 2H4a1 1 0 01-1-1V4zm12.707 5.707a1 1 0 010-1.414l-3-3a1 1 0 10-1.414 1.414L13.586 9H9a1 1 0 100 2h4.586l-1.293 1.293a1 1 0 101.414 1.414l3-3z"
                              clip-rule="evenodd"/>
                    </svg>
                    Выйти
                </Link>
            </header>

            <form @submit.prevent="submit" class="flex-1 p-6 overflow-auto">
                <div class="max-w-xl mx-auto">
                    <p class="text-sm text-gray-600 mb-4">
                        Укажите ссылку на яндекс, пример: <span class="text-blue-600">https://yandex.ru/...</span>
                    </p>

                    <div v-if="$page.props?.flash?.error" class="text-red-600 mb-2">
                        {{ $page.props.flash.error }}
                    </div>

                    <div v-if="form.errors.url" class="mb-4 p-3 bg-red-100 text-red-700 border border-red-300 rounded">
                        {{ form.errors.url }}
                    </div>

                    <div class="mb-4">
                        <input type="text"
                               @input="form.clearErrors('url')"
                               v-model="form.url"
                               required
                               name="url"
                               placeholder="https://yandex.ru/..."
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"/>
                    </div>

                    <button
                        type="submit"
                        class="px-4 py-2  cursor-pointer bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                        Сохранить
                    </button>
                </div>
            </form>
        </main>
    </div>
</template>


<script setup lang="ts">
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import {Link} from '@inertiajs/vue3'
import {useForm} from '@inertiajs/vue3'


const form = useForm({
    url: '',
});

const submit = () => {
    form.post('/yandex/reviews', {
        preserveScroll: true,
        onError: (errors) => {
            console.log('Validation errors:', errors);
        },
    });
};

</script>
