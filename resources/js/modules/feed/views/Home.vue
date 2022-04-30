<template>
    <div class="grid grid-cols-1 md:grid-cols-2 md:max-w-3xl xl:grid-cols-3 xl:max-w-4xl mx-auto">
        <section class="col-span-2">
            <Posts />
        </section>
        <section>
            <div class="fixed">
                <MiniProfile />
            </div>
        </section>
    </div>
</template>

<script>
import Posts from '../components/Posts.vue'
import MiniProfile from '../components/Miniprofile.vue'
export default {
    components: {
        Posts,
        MiniProfile
    },
    setup() {
        
    },
}
</script>