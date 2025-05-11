<template>
  <q-page padding>
    <!-- content -->
    <h4>Profile Page</h4>
    <q-inner-loading :showing="loading" color="red-8" size="65px" />
    <p>{{ user?.name || 'No name' }}</p>
    <p>{{ user?.profile?.full_name || 'No full_name' }}</p>
    <p>{{ user?.profile?.age || 'No age' }}</p>
    <p>{{ user?.profile?.nationality || 'No nationality' }}</p>
  </q-page>
</template>

<script setup>
import { api } from 'src/boot/axios'
import { onMounted, ref } from 'vue'

const user = ref('')
// const profile = ref('')
const loading = ref(false)

onMounted(() => {
  loading.value = true
  api
    .get('api/user')
    .then((r) => {
      user.value = r.data
      // profile.value = r.data.profile
    })
    .catch((e) => {
      console.log('error', e)
    })
    .finally(() => {
      loading.value = false
    })
})
</script>
