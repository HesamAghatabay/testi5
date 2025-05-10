<template>
  <q-page padding>
    <!-- content -->
    <h4>Post Page</h4>
    <q-inner-loading :showing="loading" color="red-8" size="65px" />

    <q-btn @click="$router.push('create-post')">Create New Post</q-btn>
    <div class="row q-mt-md q-gutter-sm">
      <div class="col-3" v-for="(post, index) in posts" :key="'post' + index">
        <q-card
          class="my-card text-white"
          style="background: radial-gradient(circle, #35a2ff 0%, #014a88 100%)"
        >
          <q-card-section>
            <div class="text-h6">{{ post?.name || 'no name' }}</div>
            <div class="text-subtitle2">{{ post?.body || 'no body' }}</div>
          </q-card-section>
          <q-card-actions>
            <q-btn @click="($router.push('edit-post/' + post.id), (PostData.currentPost = index))"
              >Edit</q-btn
            >
            <q-btn @click="destroy(post.id)">Delete</q-btn>
          </q-card-actions>
        </q-card>
      </div>
    </div>
  </q-page>
</template>

<script setup>
import { Notify } from 'quasar'
import { api } from 'src/boot/axios'
import { usePostData } from 'src/stores/PostData'
import { onMounted, ref } from 'vue'

const PostData = usePostData()
const loading = ref(false)
// const posts = reactive({
//   name: null,
//   body: null,
// })
const posts = ref([])
onMounted(() => {
  loading.value = true
  api
    .get('api/post')
    .then((r) => {
      posts.value = r.data
      // ;(posts.name = r.data.name), (posts.body = r.data.body)
    })
    .catch((e) => {
      console.log(e)
    })
    .finally(() => {
      loading.value = false
    })
})
function destroy($id) {
  api
    .delete('api/post/' + $id)
    .then((r) => {
      if (r.status == 200) {
        Notify.create({
          type: 'positive',
          position: 'top',
          message: 'post deleted successfuly',
        })
      }
    })
    .catch((e) => {
      console.error(e)
    })
}
</script>
