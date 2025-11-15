<template>
    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" viewBox="0 0 20 20"
                     fill="currentColor">
                    <path fill-rule="evenodd"
                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 11.414V13a1 1 0 102 0v-1.586l1.293-1.293a1 1 0 001.414-1.414z"
                          clip-rule="evenodd"/>
                </svg>
                <span class="font-semibold text-gray-800">Daily Grow</span>
            </div>
            <p class="text-xs text-gray-500 mt-1">Название аккаунта</p>
        </div>


        <nav class="p-4 space-y-2 flex-1">
            <Link
                v-for="item in navItems"
                :key="item.name"
                :href="item.url"
                :class="[
          'w-full flex items-center px-4 py-2 text-sm font-medium border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent',
          currentRoute === item.url
            ? 'bg-blue-100 text-blue-700 border-blue-300'
            : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50'
        ]"
            >
                {{ item.name }}
            </Link>
        </nav>
    </aside>

</template>

<script setup>
import {Link, usePage} from '@inertiajs/vue3'

const navItems = [
    {name: 'Отзывы', url: '/reviews'},
    {name: 'Настройки', url: '/settings'}
]

const page = usePage()
const currentRoute = page.url

</script>
