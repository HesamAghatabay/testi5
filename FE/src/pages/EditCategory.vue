<template>
  <q-page padding>
    <!-- content -->
    <h4>Edit Category Page</h4>
    <div class="row">
      <div class="col">
        <q-input
          v-model="category.name"
          label="Enter Category Name"
          standout="bg-teal text-white"
        />
      </div>
      <div class="col">
        <q-input
          v-model="category.body"
          label="Enter Category Body"
          standout="bg-teal text-white"
        />
      </div>
    </div>
    <q-btn @click="edit">Edit</q-btn>
  </q-page>
</template>

<script setup>
import { Notify } from 'quasar'
import { api } from 'src/boot/axios'
import { useCategoryData } from 'src/stores/CatagoryData'
import { onMounted, reactive } from 'vue'
import { useRoute, useRouter } from 'vue-router'

const route = useRoute()
const router = useRouter()
const category = reactive({
  name: null,
  body: null,
})
const categoryData = useCategoryData()
onMounted(() => {
  if (categoryData.currentCategory.length > 0) {
    ;(category.name = categoryData.currentCategory.name),
      (category.body = categoryData.currentCategory.body)
  } else {
    fetchcategory()
  }
})
function fetchcategory() {
  api
    .get('api/category/' + route.params.id)
    .then((r) => {
      ;(category.name = r.data.name), (category.body = r.data.body)
    })
    .catch((e) => {
      console.log(e)
    })
}
function edit() {
  api
    .put('api/category/' + route.params.id, category)
    .then((r) => {
      router.push('/category')
      Notify.create({
        type: 'positive',
        position: 'top',
        message: 'category updated successfuly',
      })
      console.log('data', r.date)
    })
    .catch((e) => {
      Notify.create({
        type: 'negative',
        position: 'top',
        message: 'we have error in catch',
      })
      console.log(e)
    })
}
</script>
