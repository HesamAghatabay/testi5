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
          label="Enter Phone"
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
          label="Enter Phone"
          :type="isPwd ? 'password' : 'text'"
          ><template v-slot:append>
            <q-icon
              :name="isPwd ? 'visibility_off' : 'visibility'"
              class="cursor-pointer"
              @click="isPwd = !isPwd"
            /> </template
        ></q-input>
      </div>
    </div>

  </q-page>
</template>

<script setup>
import { reactive, Ref } from 'vue';



const form = reactive({
  name : null,
  phone : null,
  password : null,
  confirmpassword : null,
})
const isPwd = Ref(true)
</script>
