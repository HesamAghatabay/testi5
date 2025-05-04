<template>
  <q-page padding>
    <!-- content -->
    <h4>Send Verify page</h4>
    <q-input
      type="tel"
      standout="bg-teal text-white"
      label="Enter your Phone Number"
      v-model="phone"
    />
    <q-btn @click="sendsms">Send</q-btn>
  </q-page>
</template>

<script setup>
import { Notify } from 'quasar'
import { api } from 'src/boot/axios'
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const phone = ref('')

function sendsms() {
  api
    .post('api/sendverify', {
      username: phone.value,
    })
    .then((r) => {
      console.log(r.data.status)
      router.push('confirmlogin/' + phone.value)
      Notify.create({
        type: 'positive',
        position: 'top',
        message: 'SMS with new password send successfuly',
      })
      // alert('send successfully')
    })
    .catch((e) => {
      console.log(e)
      Notify.create({
        type: 'negative',
        position: 'top',
        message: 'we have error in catch',
      })
      // alert('we have error in catch')
    })
}
</script>
