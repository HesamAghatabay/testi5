import { defineStore, acceptHMRUpdate } from 'pinia'

export const useCategoryData = defineStore('CategoryData', {
  state: () => ({
    catagory: [],
    currentCategory: [],
    user: [],
  }),
  getters: {},
  actions: {},
})

if (import.meta.hot) {
  import.meta.hot.accept(acceptHMRUpdate(useCategoryData, import.meta.hot))
}
