<template>
    <div>
        <div class="row m-3">
            <div class="user-block col-md-1 col-2">
                <img class="img-circle" style="height:  60px; width: 60px; z-index: 2"
                     :src="sessionData?.user?.avatar" alt="User Image">
            </div>
            <div class="col-md-11 col-10">
                <input type="text" class="form-control status-box" name="" id="" placeholder="What's on your mind?"
                       @click="showPostCreateUpdateModal">
            </div>
        </div>
        <div class="row">
            <Posts>
                <SinglePost
                    v-for="post in posts"
                    :key="post.id"
                    :post="post"
                    :sessionData="sessionData"
                    @editButtonClick="editPost"
                    @deleteButtonClick="deletePost"
                    @pushComments="pushComments"
                />
            </Posts>
        </div>
        <!-- /.row -->

        <modal name="create-update-post-modal"
               :adaptive="true"
               :pivot-y="0.5"
               :pivot-x="0.5"
               @before-open="beforePostCreateUpdateModalOpen"
               @closed="editData = {}"
               :width="800"
               height="auto"
        >
            <post-create-update-modal
                :sessionData="sessionData"
                :editData="editData"
                @postCreated="updateTimelinePost"
                @postUpdated="updateTimelinePost"
                @closeModal="closeModal"
            />
        </modal>
        <v-dialog/>
    </div>
</template>

<script>
import PostCreateUpdateModal from './PostCreateUpdateModal.vue';
import Posts from "./Posts.vue";
import SinglePost from "./SinglePost.vue";

export default {
    components: {
        Posts,
        SinglePost,
        PostCreateUpdateModal,
    },
    name: "Home",
    data() {
        return {
            posts: [],
            sessionData: [],
            editData: {},
        }
    },
    methods: {
        beforePostCreateUpdateModalOpen(event) {
            if (event.params.post) {
                this.editData = event.params.post;
            }
        },
        showPostCreateUpdateModal: function () {
            this.$modal.show('create-update-post-modal', {
                post: null
            });
        },
        closeModal: function () {
            this.editData = {};
            this.$modal.hide('create-update-post-modal');
        },
        updateTimelinePost: function (data) {
            this.updatePostInPostsArray(this.posts, data);
            // this.fetchPosts();
            this.closeModal();
        },
        updatePostInPostsArray: function (posts, data) {
            if (!data) {
                return;
            }
            const index = posts.findIndex(post => post.id === data.id);
            if (index !== -1) {
                posts[index] = data;
                return;
            }
            this.posts.unshift(data);
        },
        editPost: function (post) {
            this.$modal.show('create-update-post-modal', {
                post: post
            });
        },
        deletePost: function (post) {
            try {
                axios.delete(`/api/v1/posts/${post.id}`);
                this.$toast.success('Post deleted successfully');
                this.fetchPosts();
            } catch (error) {
                console.log(error);
                this.$toast.error('Something went wrong');
            }
            console.log(post);
        },
        fetchStaticData: async function () {
            try {
                const {data: {data}} = await axios.get('/api/v1/static-data-for-home-page');
                this.sessionData = data;
            } catch (error) {
                console.log(error);
                this.$toast.error('Something went wrong');
            }
        },
        fetchPosts: async function () {
            try {
                const {data: {data}} = await axios.get('/api/v1/posts');
                this.posts = data;
            } catch (error) {
                console.log(error);
                this.$toast.error('Something went wrong');
            }
        },
        pushComments: function (comments, postId) {
            if(comments.length == 0) return;

            this.posts = this.posts.map(post => {
                if (post.id === postId) {
                    post.comments.push(...comments);
                }
                return post;
            });
        }
    },
    mounted() {
        this.fetchStaticData();
        this.fetchPosts();
    }
}
</script>

<style scoped>

</style>
