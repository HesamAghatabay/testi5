<template>
  <q-page padding>
    <!-- content -->
    <h4>Post Page</h4>
    <q-inner-loading :showing="loading" color="red-8" size="65px" />

    <q-btn @click="$router.push('create-post')">Create New Post</q-btn>
    <div class="row q-mt-md q-gutter-sm">
      <div class="col-3" v-for="(post, index) in posts" :key="'post' + index">
        <q-card
          class="my-card text-white"
          style="background: radial-gradient(circle, #35a2ff 0%, #014a88 100%)"
        >
          <q-card-section @click="$router.push('show-post/' + post.id)">
            <div class="text-h6">{{ post?.name || 'no name' }}</div>
            <div class="text-subtitle2">{{ post?.body || 'no body' }}</div>
          </q-card-section>
          <q-card-actions>
            <q-btn @click="($router.push('edit-post/' + post.id), (PostData.currentPost = index))"
              >Edit</q-btn
            >
            <q-btn @click="destroy(post.id)">Delete</q-btn>
            <!-- <div>
              <q-btn @click="unlike(index)">👎</q-btn>
              <q-btn @click="like(index)">👍</q-btn>
              <span>{{ post.likes.length }}</span>
            </div> -->
            <div>
              <q-btn
                @click="post.liked ? unlike(index) : like(index)"
                :color="post.liked ? 'blue-5' : 'grey-6'"
              >
                <q-icon name="favorite" :color="post.likes.length ? 'red' : 'grey-8'" />
                <span>{{ post.likes.length }}</span>
              </q-btn>
            </div>
            <!-- <div class="like-button">
              <q-btn
                unelevated
                :color="post.liked ? 'red' : 'grey-6'"
                text-color="white"
                :loading="post.loading"
                @click="toggleLike(index)"
                padding="sm"
                no-caps
              >
                <q-icon name="favorite" :color="post.liked ? 'white' : 'grey-8'" />
                <span class="q-ml-xs">{{ post.likes_count }}</span>
              </q-btn>
            </div> -->
          </q-card-actions>
        </q-card>
      </div>
    </div>
  </q-page>
</template>

<script setup>
import { Notify } from 'quasar'
import { api } from 'src/boot/axios'
import { usePostData } from 'src/stores/PostData'
import { onMounted, ref } from 'vue'
// import { useRouter } from 'vue-router'

// const router = useRouter()
const PostData = usePostData()
const loading = ref(false)
// const posts = reactive({
//   name: null,
//   body: null,
// })
// const likeCount = ref()
const posts = ref([])
onMounted(() => {
  loading.value = true
  api
    .get('api/post')
    .then((r) => {
      posts.value = r.data
      // ;(posts.name = r.data.name), (posts.body = r.data.body)
    })
    .catch((e) => {
      console.log(e)
    })
    .finally(() => {
      loading.value = false
    })
})

// function toggleLike(index) {
//   const post = posts.value[index]
//   const postId = post.id
//   const isLiked = post.liked

//   const url = isLiked ? `/api/post/${postId}/unlike` : `/api/post/${postId}/like`

//   post.loading = true

//   api
//     .post(url)
//     .then(() => {
//       // روش ۱: اگر API فقط وضعیت رو برمیگردونه
//       post.liked = !isLiked
//       post.likes_count = isLiked ? post.likes_count - 1 : post.likes_count + 1

//       // روش ۲: اگر API count رو برمیگردونه
//       // post.likes_count = res.data.count
//     })
//     .catch((e) => {
//       console.error('Toggle failed:', e)
//     })
//     .finally(() => {
//       post.loading = false
//     })
// }

// function togglelike(index) {
//   const postId = posts.value[index].id
// }

function like(index) {
  const postId = posts.value[index].id
  api
    .post('api/post/' + postId + '/like')
    .then((r) => {
      console.log(r.data)
    })
    .catch((e) => {
      console.error(e)
    })
}
function unlike(index) {
  const postId = posts.value[index].id
  api
    .post('api/post/' + postId + '/unlike')
    .then((r) => {
      console.log(r.data)
    })
    .catch((e) => {
      console.error(e)
    })
}

function destroy($id) {
  api
    .delete('api/post/' + $id)
    .then((r) => {
      if (r.status == 200) {
        Notify.create({
          type: 'positive',
          position: 'top',
          message: 'post deleted successfuly',
        })
      }
    })
    .catch((e) => {
      console.error(e)
    })
}
</script>
