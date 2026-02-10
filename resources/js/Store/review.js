import {defineStore} from 'pinia'


export const useReviewsStore = defineStore('reviews', {
    state: () => ({
        organization: null,
        expiresAt: null
    }),

    actions: {
        setOrganization(data) {
            this.organization = data
            this.expiresAt = Date.now() + 5 * 60 * 1000
        },

        clearExpired() {
            if (this.expiresAt && Date.now() > this.expiresAt) {
                this.organization = null
                this.expiresAt = null
            }
        }
    },

    persist: true
})
