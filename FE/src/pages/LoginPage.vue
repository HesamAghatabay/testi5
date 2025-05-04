<template>
  <q-page padding>
    <!-- content -->
    <h4>Login Page</h4>
    <div class="row q-col-gutter-md">
      <div class="col-md-6">
        <q-input standout="bg-teal text-white" v-model="phone" label="Enter Phone" type="text" />
      </div>
      <div class="col-md-6">
        <q-input
          standout="bg-teal text-white"
          v-model="password"
          label="Enter password"
          :type="isPwd ? 'password' : 'text'"
        >
          <template v-slot:append>
            <q-icon
              :name="isPwd ? 'visibility_off' : 'visibility'"
              class="cursor-pointer"
              @click="isPwd = !isPwd"
            />
          </template>
        </q-input>
      </div>
    </div>
    <q-btn class="q-ma-lg" @click="login" color="red" icon="mail" icon-right="send" label="Login" />
    <q-btn color="blue-8" @click="$router.push('sendverify')">Forget password</q-btn>
  </q-page>
</template>

<script setup>
import { api } from 'src/boot/axios'
import { ref } from 'vue'
import { useRouter } from 'vue-router'
const phone = ref('')
const password = ref('')
// const form = reactive({
//   phone: null,
//   password: null,
// })
const router = useRouter()
const isPwd = ref(true)
function login() {
  if (!phone.value || !password.value) {
    alert('لطفا تمام فیلدها را پر کنید')
    return
  }
  api
    .post('oauth/token', {
      grant_type: 'password',
      client_id: 2,
      client_secret: 'vYRFXpOqBMeMZrHdG35aZVRdDDCiwX001IJMT9M3',
      username: phone.value,
      password: password.value,
      scope: '*',
    })
    .then((r) => {
      if (r.data.access_token) {
        localStorage.setItem('access_token', r.data.access_token)
        router.push('/')
      } else {
        router.push('register')
      }
    })
    .catch((e) => {
      console.log(e)
      // router.push('register')
    })
}
</script>
