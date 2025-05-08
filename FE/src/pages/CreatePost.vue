<template>
  <q-page padding>
    <!-- content -->
    <h4>Create Post Page</h4>
    <div class="row q-gutter-sm">
      <div class="col">
        <q-input v-model="post.name" label="Enter Category Name" standout="bg-teal text-white" />
      </div>
      <div class="col">
        <q-input v-model="post.name" label="Enter Category Name" standout="bg-teal text-white" />
      </div>
      <div class="col">
        <q-input
          v-model="post.categoryId"
          label="Enter Category Name"
          standout="bg-teal text-white"
        />
      </div>
    </div>
    <q-btn @click="create">Create</q-btn>
  </q-page>
</template>

<script setup>
import { Notify } from 'quasar'
import { api } from 'src/boot/axios'
import { reactive } from 'vue'

const post = reactive({
  name: null,
  body: null,
  categoryId: null,
})

function create() {
  if (!post.name.value || !post.body.value) {
    api
      .post('api/post', post)
      .then((r) => {
        if (r.data.status === 201) {
          Notify.create({
            type: 'positive',
            position: 'top',
            message: 'post created successfuly',
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
