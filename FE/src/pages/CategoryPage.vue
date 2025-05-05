<template>
  <q-page padding>
    <!-- content -->
    <h5>Category Page</h5>
    <q-btn @click="$router.push('create-category')">Create Category</q-btn>
    <div class="row q-mt-md">
      <div class="col-3" v-for="(category, index) in categories" :key="'category' + index">
        <p>{{ category?.name || 'ss' }}</p>
        <!-- <q-card
          class="my-card text-white"
          style="background: radial-gradient(circle, #35a2ff 0%, #014a88 100%)"
        >
          <q-card-section>
            <div class="text-h6">{{ category?.name || 'error name' }}</div>
            <div class="text-subtitle2">{{ category?.body || 'error body' }}</div>
          </q-card-section>
        </q-card> -->
      </div>
    </div>
  </q-page>
</template>

<script setup>
import { api } from 'src/boot/axios'
import { onMounted, ref } from 'vue'

const categories = ref([])
onMounted(() => {
  getCategory()
})
function getCategory() {
  api
    .get('api/category')
    .then((r) => {
      categories.value = r.data
    })
    .catch((e) => {
      console.log(e)
    })
}
</script>
