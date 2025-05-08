<template>
  <q-page padding>
    <!-- content -->
    <h5>Category Page</h5>
    <q-inner-loading :showing="loading" color="red-8" size="65px" />
    <q-btn @click="$router.push('create-category')">Create Category</q-btn>
    <div class="row q-mt-md q-gutter-sm">
      <div class="col-3" v-for="(category, index) in categories" :key="'category' + index">
        <!-- <p>{{ category?.name || 'ss' }}</p> -->
        <q-card
          class="my-card text-white"
          style="background: radial-gradient(circle, #35a2ff 0%, #014a88 100%)"
        >
          <q-card-section>
            <div class="text-h6">{{ category?.name || 'error name' }}</div>
            <div class="text-subtitle2">{{ category?.body || 'error body' }}</div>
          </q-card-section>
          <q-card-actions>
            <q-btn
              @click="
                ((categoryData.currentCategory = index),
                $router.push('edit-category/' + category.id))
              "
              >Edit</q-btn
            >
            <q-btn @click="destroy(category.id)">Delete</q-btn>
          </q-card-actions>
        </q-card>
      </div>
    </div>
  </q-page>
</template>

<script setup>
import { Notify } from 'quasar'
import { api } from 'src/boot/axios'
import { useCategoryData } from 'src/stores/CatagoryData'
import { onMounted, ref } from 'vue'

const categories = ref([])
const loading = ref(false)
const categoryData = useCategoryData()
onMounted(() => {
  loading.value = true
  api
    .get('api/category')
    .then((r) => {
      // console.log('myCategory', r.data)
      // console.log("Categories received:", categories.value);
      categories.value = r.data
      categoryData.catagory = r.data
    })
    .catch((e) => {
      console.log(e)
      console.error('Data:', e.response.data)
      console.error('First item in data:', e.response.data[0])
      console.error('Server responded with:', e.response.status)
    })
    .finally(() => {
      loading.value = false
    })
})
function destroy($id) {
  api
    .delete('api/category/' + $id)
    .then((r) => {
      Notify.create({
        type: 'positive',
        position: 'top',
        message: 'category deleted successfuly',
      })
      console.log(r.data)
    })
    .catch((e) => {
      console.log(e)
    })
}
</script>
