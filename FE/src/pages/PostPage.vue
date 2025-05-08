<template>
  <q-page padding>
    <!-- content -->
    <h4>Post Page</h4>
    <q-btn @click="$router.push('create-post')">Create New Post</q-btn>
    <div class="row q-mt-md q-gutter-sm">
      <div class="col-3">
        <q-card
          class="my-card text-white"
          style="background: radial-gradient(circle, #35a2ff 0%, #014a88 100%)"
        >
          <q-card-section>
            <div class="text-h6">s</div>
            <div class="text-subtitle2">ss</div>
          </q-card-section>
          <q-card-actions>
            <q-btn>Edit</q-btn>
            <q-btn>Delete</q-btn>
          </q-card-actions>
        </q-card>
      </div>
    </div>
  </q-page>
</template>

<script setup>
//
</script>
