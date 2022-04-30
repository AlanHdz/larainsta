<template>
  <Post v-for="(post, index) in posts" :key="index" :post="post" />  
</template>

<script>
import { ref, onMounted } from 'vue'
import Post from '../components/Post.vue'
import useFeed from '../composables/useFeed'
export default {
  components: {
    Post
  },
  setup() {
    
    const { getPosts, posts } = useFeed()

    onMounted(async () => {
      await getPosts()
    })

    return {
      posts
    }
  },
}
</script>