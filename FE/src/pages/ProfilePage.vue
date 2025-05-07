<template>
  <q-page padding>
    <!-- content -->
    <h4>Profile Page</h4>
    <p>{{ user?.name || 'No name' }}</p>
    <!-- <p>{{ user?.profile. || 'No name' }}</p> -->
  </q-page>
</template>

<script setup>
import { api } from 'src/boot/axios'
import { onMounted, ref } from 'vue'

const user = ref('')

onMounted(() => {
  api
    .get('api/user')
    .then((r) => {
      user.value = r.data
    })
    .catch((e) => {
      console.log('error', e)
    })
})
</script>
