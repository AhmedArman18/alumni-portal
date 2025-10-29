<template>
    <div class="card-comment">
        <!-- User image -->
        <img class="img-circle img-sm" :src="comment.commented_by_avatar" alt="User Image">

        <div class="comment-text">
            <span class="username">
                {{ comment.commented_by }}
                <span class="text-muted float-right">{{ formatDateTimeForHuman(comment.created_at) }}</span>
            </span>
            <!-- /.username -->
            {{ comment.body }}
        </div>
        <!-- /.comment-text -->
        <!-- like and reply -->
        <div class="float-right" style="margin-top: -20px;">
            <a @click.prevent="handleCommentLikeBtnClick" class="btn btn-default btn-sm">
                <i :style="comment.is_liked ? 'color: red' : ''" class="fa fa-heart"></i> Like</a>
                <span class="text-muted">{{ comment.like_count }} likes</span>
            <!-- <a @click="handleReplyButtonClick" :class="['btn btn-default btn-sm', isReplying ? 'replying' : '']"><i class="fa fa-reply"></i> Reply</a> -->
        </div>
        <!-- reply box -->
        <!-- <div>
            <div class="img-push mt-3" v-if="isReplying">
                <input type="text" v-model="replyText" class="form-control form-control-sm" placeholder="Press enter to reply" @keypress.enter.prevent="handleEnterPress">
            </div>
        </div> -->
    </div>
</template>

<script>
import moment from 'moment';
export default {
    name: "SingleComment",
    props: {
        comment: {
            type: Object,
            default: () => {
            }
        }
    },
    data() {
        return {
            isReplying: false,
            replyText: ''
        }
    },
    methods: {
        formatDateTimeForHuman: function (dateTime) {
            return moment(dateTime).fromNow();
        },
        handleReplyButtonClick: function () {
            this.isReplying = !this.isReplying;
        },
        handleCommentLikeBtnClick: async function () {
            const {data} = await axios.post(`/api/v1/posts/comments/${this.comment.id}/like-insert-delete`);
            this.comment.is_liked = data.is_liked;
            this.comment.like_count = data.like_count;
        },
    }
}
</script>

<style scoped>
    .replying {
        background-color: black;
        color: white;
    }
</style>
