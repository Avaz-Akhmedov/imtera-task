<template>
    <div class="bg-gray-50 min-h-screen flex flex-col lg:flex-row">
        <DashboardLayout />

        <main class="flex-1 p-4 lg:p-6">

            <div v-if="!organization" class="text-center text-gray-600 mt-20 text-lg">
                Нет данных. Перейдите в настройки и вставьте ссылку.
            </div>

            <div v-else class="flex flex-col lg:flex-row gap-6">

                <!-- Left side -->
                <div class="flex-1 mt-8 lg:mt-12">
                    <div class="flex flex-col space-y-6 max-w-2xl lg:ml-12 mx-auto">

                        <div
                            v-for="(review, index) in organization.reviews"
                            :key="index"
                            class="bg-white rounded-xl shadow-sm border border-gray-100 p-5"
                        >
                            <div class="flex justify-between items-start mb-3">

                                <div class="flex items-center space-x-3">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ review.reviewDate }}
                                    </div>
                                </div>

                                <div class="flex space-x-1">
                                    <template v-for="n in Math.round(review.reviewRating)" :key="n">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.95a1 1 0 00.95.69h4.15c.969 0 1.371 1.24.588 1.81l-3.36 2.44a1 1 0 00-.364 1.118l1.286 3.95c.3.921-.755 1.688-1.54 1.118l-3.36-2.44a1 1 0 00-1.176 0l-3.36 2.44c-.784.57-1.838-.197-1.539-1.118l1.286-3.95a1 1 0 00-.364-1.118L2.075 9.377c-.783-.57-.38-1.81.588-1.81h4.15a1 1 0 00.95-.69l1.286-3.95z"/>
                                        </svg>
                                    </template>
                                </div>

                            </div>

                            <div class="flex items-center mb-2">
                                <span class="text-sm font-medium text-gray-900 mr-3">
                                    {{ review.reviewerName }}
                                </span>
                            </div>

                            <p class="text-sm text-gray-700 leading-relaxed">
                                {{ review.reviewText }}
                            </p>

                        </div>

                    </div>
                </div>

                <div class="w-full lg:w-64 sticky top-6 self-start">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                        <div class="flex items-center justify-between mb-4">
                            <div class="text-3xl font-bold text-gray-900">
                                {{ organization.rating }}
                            </div>
                        </div>
                        <div class="border-t border-gray-200 pt-4">
                            <div class="text-sm text-gray-600">
                                Всего отзывов: {{ organization.countOfReviews }}
                            </div>
                            <div class="text-sm text-gray-600 mt-1">
                                Количество оценок: {{ organization.countOfRatings }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </main>
    </div>
</template>

<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import { useReviewsStore } from "./../Store/review.js";

const store = useReviewsStore();

store.clearExpired();

const organization = store.organization;
</script>
