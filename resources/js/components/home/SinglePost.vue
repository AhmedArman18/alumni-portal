<template>
    <div>
        <div class="card card-widget">
            <div class="card-header">
                <div class="user-block">
                    <img class="img-circle" :src="post.author_avatar" alt="User Image">
                    <span class="username"><a href="#">{{ post.author_name }}</a></span>
                    <span class="description">Privacy {{ post.privacy_name }} - {{ post.created_at }}</span>
                </div>
                <!-- /.user-block -->
                <div class="card-tools" v-if="Number(post.author_id) === Number(sessionData.user.id)">
                    <button type="button" class="btn btn-sm btn-primary" title="Edit"
                            @click="handleEditButtonClick">
                        <i class="far fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-danger" title="Delete"
                            @click="handleDeleteButtonClick">
                        <i class="fas fa-trash"></i>
                    </button>
                    <!--                    <button type="button" class="btn btn-tool" data-card-widget="remove">-->
                    <!--                        <i class="fas fa-times"></i>-->
                    <!--                    </button>-->
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <p>{{ post.content }}</p>
                <div class="post-img-container">
                    <img class="img-fluid pad"
                     :style="post.images.length != 1 ? 'width: 340px; max-height: 340px' : ''"
                      v-for="(image, index) in post.images" :key="index" :src="image.image_url" alt="Photo">
                </div>
                <!-- <button type="button" class="btn btn-default btn-sm"><i class="fas fa-share"></i>
                    Share
                </button> -->
                <button type="button" @click="handleLikeButtonClick" class="btn btn-default btn-sm">
                    <i :style="post.is_liked ? 'color: red' : ''" class="far fas fa-heart"></i>
                    <!-- red heart -->
                    Like
                </button>
                <span class="float-right text-muted">{{ post.like_count }} likes - {{ post.comment_count }} comments
                </span>
            </div>
            <!-- /.card-body -->
                <Comments
                :postId="post.id"
                :comments="post.comments"
                :commentCount="post.comment_count"
                @load-more-comment="handleLoadMoreComment"
                />
            <!--             /.card-footer -->
            <div class="card-footer">
                <form action="#" method="post">
                    <img class="img-fluid img-circle img-sm"
                        :src="sessionData.user.avatar"
                         alt="Alt Text">
                    <!-- .img-push is used to add margin to elements next to floating images -->
                    <div class="img-push d-flex">
                        <input type="text" v-model="comment_body" @keypress.enter.prevent="handleEnterKeyPress" class="form-control form-control-sm mr-1"
                               placeholder="Press enter to post comment">
                        <a href="#" @click.prevent="handleCommentBtnClick"><i class="fa fa-paper-plane"></i></a>
                    </div>
                </form>
            </div>
            <!-- /.card-footer -->
        </div>
    </div>
</template>

<script>
import Comments from "./Comments";
import SingleComment from './SingleComment';
export default {
    name: "SinglePost",
    props: {
        post: {
            type: Object,
            default: () => {
            }
        },
        sessionData: {
            type: Object,
            default: () => {
            }
        }
    },
    components: {
        Comments,
        SingleComment
    },
    data() {
        return {
            comment_body: '',
            currentOffset: 1,
        }
    },
    methods: {
        handleEditButtonClick() {
            this.$emit('editButtonClick', this.post);
        },
        handleDeleteButtonClick() {
            this.$modal.show('dialog', {
                title: 'Delete Post',
                text: 'Are you sure you want to delete this post?',
                buttons: [
                    {
                        title: 'Yes',
                        handler: () => {
                            this.$modal.hide('dialog');
                            this.$emit('deleteButtonClick', this.post);
                        }
                    },
                    {
                        title: 'No',
                        default: true,
                        handler: () => {
                            this.$modal.hide('dialog');
                        }
                    }
                ]
            });
        },
        handleLikeButtonClick: async function () {
            try {
                const {data} = await axios.post(`/api/v1/posts/${this.post.id}/like-insert-delete`);
                this.post.is_liked = data.is_liked;
                this.post.like_count = data.like_count;
            } catch (e) {
                console.error(e);
            }
        },
        handleCommentBtnClick: async function () {
            this.postAComment();
        },
        handleEnterKeyPress: function (event) {
            if (event.keyCode === 13) {
                this.postAComment();
            }
        },
        postAComment: async function () {
            try {
                const {data: { data }} = await axios.post(`/api/v1/posts/comments/${this.post.id}`, {
                    body: this.comment_body
                });
                this.post.comments.push(data);
                this.post.comment_count++;
                this.comment_body = '';
            } catch (e) {
                console.error(e);
            }
        },
        handleLoadMoreComment: async function (postId) {
            try {
                const {data: {data}} = await axios.get(`/api/v1/posts/comments/${this.post.id}/?offset=${this.currentOffset}`);
                // this.comments.push(...this.comments, ...data);
                this.currentOffset += 5;
                this.$emit('pushComments', data, this.post.id);
            } catch (error) {
                console.log(error);
            }
        }
    }
}
</script>

<style scoped>
* {
    box-sizing: border-box;
}
div.post-img-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    padding: 5px;
}
.post-img-container img {
    margin: 5px;
}
</style>
