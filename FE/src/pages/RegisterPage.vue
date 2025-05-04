<template>
  <q-page padding>
    <!-- content -->
    <h4>Register Page</h4>
    <div class="row q-col-gutter-md">
      <div class="col-md-6">
        <q-input standout="bg-teal text-white" v-model="form.name" label="Enter Name" type="text" />
      </div>
      <div class="col-md-6">
        <q-input
          standout="bg-teal text-white"
          v-model="form.phone"
          label="Enter Phone"
          type="text"
        />
      </div>
      <div class="col-md-6">
        <q-input
          standout="bg-teal text-white"
          v-model="form.password"
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
      <div class="col-md-6">
        <q-input
          standout="bg-teal text-white"
          v-model="form.confirmpassword"
          label="Enter confirmpassword"
          :type="isPwdc ? 'password' : 'text'"
          ><template v-slot:append>
            <q-icon
              :name="isPwdc ? 'visibility_off' : 'visibility'"
              class="cursor-pointer"
              @click="isPwdc = !isPwdc"
            /> </template
        ></q-input>
      </div>
    </div>
    <div>
      <q-btn
        class="q-ma-lg"
        @click="register"
        color="red"
        icon="mail"
        icon-right="send"
        label="Register"
      />
    </div>
  </q-page>
</template>

<script setup>
import { Notify } from 'quasar'
import { api } from 'src/boot/axios'
import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'

const form = reactive({
  name: null,
  phone: null,
  password: null,
  confirmpassword: null,
})
const isPwd = ref(true)
const isPwdc = ref(true)
const router = useRouter()

function register() {
  api
    .post('api/register', form)
    .then((r) => {
      console.log(r.data)
      Notify.create({
        type: 'positive',
        position: 'top',
        message: 'User register successfuly',
      })
      router.push('login')
    })
    .catch((e) => {
      console.log(e)
      Notify.create({
        type: 'negative',
        position: 'top',
        message: 'User register successfuly',
      })
    })
}
</script>
