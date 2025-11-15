<script setup>
import { useReviewsStore } from './../Store/review.js'
import { router } from '@inertiajs/vue3'

const props = defineProps({
    scraped: Object
})

const store = useReviewsStore()

store.setOrganization(props.scraped)

router.visit('/reviews')
</script>

<template>
    <div class="p-8 text-center text-gray-600">
        Загрузка...
    </div>
</template>
