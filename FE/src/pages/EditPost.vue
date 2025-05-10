<template>
  <q-page padding>
    <!-- content -->
    <h4>Edit Post Page</h4>
    <div class="row q-gutter-sm">
      <div class="col">
        <q-input v-model="post.name" label="Enter post Name" standout="bg-teal text-white" />
      </div>
      <div class="col">
        <q-input v-model="post.body" label="Enter post body" standout="bg-teal text-white" />
      </div>
    </div>
    <q-btn @click="edit">Edit</q-btn>
  </q-page>
</template>

<script setup>
import { Notify } from 'quasar'
import { api } from 'src/boot/axios'
import { reactive } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const post = reactive({
  name: null,
  body: null,

})

function edit() {
  if (!post.name.value || !post.body.value) {
    api
      .put('api/post', post)
      .then((r) => {
        if (r.status === 200) {
          router.push('post')
          Notify.create({
            type: 'positive',
            position: 'top',
            message: 'post updated successfuly',
          })
        }
      })
      .catch((e) => {
        Notify.create({
          type: 'negative',
          position: 'top',
          message: 'we have error in catch',
        })
        console.error(e)
      })
  } else {
    Notify.create({
      type: 'negative',
      position: 'top',
      message: 'please poring the filds',
    })
  }
}
</script>
