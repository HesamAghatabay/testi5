import { defineStore, acceptHMRUpdate } from 'pinia'

export const usePostData = defineStore('PostData', {
  state: () => ({
    posts: [],
    currentPost: [],
    user: [],
  }),
  getters: {},
  actions: {},
})

if (import.meta.hot) {
  import.meta.hot.accept(acceptHMRUpdate(usePostData, import.meta.hot))
}
