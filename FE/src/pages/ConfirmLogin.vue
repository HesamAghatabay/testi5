<template>
  <q-page padding>
    <!-- content -->
    <h4>Confirm Login</h4>
    <q-input
      label="Enter New Password"
      type="password"
      v-model="password"
      standout="bg-teal text-white"
    ></q-input>
    <q-btn @click="login">Login</q-btn>
  </q-page>
</template>

<script setup>
import { Notify } from 'quasar'
import { api } from 'src/boot/axios'
import { ref } from 'vue'
import { useRoute, useRouter } from 'vue-router'

const password = ref('')
const route = useRoute()
const router = useRouter()

function login() {
  api
    .post('oauth/token', {
      grant_type: 'password',
      client_id: 2,
      client_secret: 'vYRFXpOqBMeMZrHdG35aZVRdDDCiwX001IJMT9M3',
      username: route.params.phone,
      password: password.value,
      scope: '*',
    })
    .then((r) => {
      router.push('/')
      console.log(r.data)
      Notify.create({
        type: 'positive',
        position: 'top',
        message: 'Login with new passport successfuly',
      })
    })
    .catch((e) => {
      console.log(e)
      Notify.create({
        type: 'negative',
        position: 'top',
        message: 'we have error in catch',
      })
    })
}
</script>
