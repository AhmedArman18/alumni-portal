<template>
    <div class="card-footer card-comments" v-if="!!comments.length">
        <SingleComment v-for="(comment, index) in comments" :key="index" :comment="comment"></SingleComment>
        <a @click.prevent="handleLoadMoreComment" class="text-primary load-more-comment-btn">Load more comments</a>
    </div>
</template>

<script>
import SingleComment from './SingleComment';
export default {
    name: "Comments",
    props: {
        postId: {
            type: Number,
            default: 0
        },
        comments: {
            type: Array,
            default: () => {
                []
            }
        },
        commentCount: {
            type: Number,
            default: 0
        }
    },
    data() {
        return {}
    },
    components: {
        SingleComment
    },
    methods: {
        handleLoadMoreComment: function () {
            this.$emit('load-more-comment', this.postId);
        }
    }
}
</script>

<style scoped>
.load-more-comment-btn {
    display: block;
    margin-top: 10px;
}
.load-more-comment-btn:hover {
    text-decoration: underline;
}
</style>
