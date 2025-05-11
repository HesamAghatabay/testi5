<template>
  <q-page padding>
    <!-- content -->
    <h4>Show Post Page</h4>

    <div class="row">
      <div class="col">
        <p>{{ post.name }}</p>
      </div>
      <div class="col">
        <p>{{ post.body }}</p>
      </div>
    </div>
  </q-page>
</template>

<script setup>
import { api } from 'src/boot/axios'
import { onMounted, ref } from 'vue'
import { useRoute } from 'vue-router'

const post = ref([])
const route = useRoute()
const postId = route.params.id
onMounted(() => {
  api
    .get('api/post/' + postId)
    .then((r) => {
      post.value = r.data
    })
    .catch((e) => {
      console.error(e)
    })
})
</script>
