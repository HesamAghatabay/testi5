<template>
  <q-page padding>
    <!-- content -->
    <h5>Category Page</h5>
    <q-btn @click="$router.push('create-category')">Create Category</q-btn>
    <div class="row q-mt-md">
      <div class="col-3">
        <q-card
          class="my-card text-white"
          style="background: radial-gradient(circle, #35a2ff 0%, #014a88 100%)"
        >
          <q-card-section>
            <div class="text-h6">Our Changing Planet</div>
            <div class="text-subtitle2">by John Doe</div>
          </q-card-section>
        </q-card>
      </div>
    </div>
  </q-page>
</template>

<script setup>
//
</script>
