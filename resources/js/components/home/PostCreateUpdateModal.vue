<template>
    <div>
        <div class="card card-widget">
            <div class="card-header">
                <div class="user-block">
                    <img class="img-circle" src="/img/user1-128x128.jpg" alt="User Image">
                    <span class="username"><a href="#">{{ sessionData.user.name }}</a></span>
                    <span class="description" style="height: 30px;">
                        Public
                        <!-- <Select2
                        :options="privacyOptions"
                        v-model="formData.privacy_id"
                        disabled
                    >
                    </Select2> -->
                    </span>
                </div>
                <!-- /.user-block -->
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" @click="handleXButtonClick">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <textarea placeholder="Whats Your mind?" class="form-control" v-model="formData.content" cols="30"
                          rows="10"></textarea>

            <div class="image-preview-container d-flex" v-if="formData.images.length">
                <div v-for="(image, index) in formData.images" :key="index" style="position: relative;">
                    <button style="position: absolute;top: 5px;left: 0;" type="button" class="btn btn-xs btn-danger" @click="removeImage(index)">
                        <i class="fas fa-times"></i>
                    </button>
                    <img height="100" width="100" :src="image.image_url" alt="" class="image-preview" v-if="image.image_url">
                </div>
            </div>

            <input type="file" class="form-control" ref="imageUploader" @change="handleFileUpload">

            </div>
            <!-- /.card-body -->
            <!-- /.card-footer -->
            <div class="card-footer">
                <!-- post button -->
                <button type="button" :class="[this.formData.id ? 'btn-success' : 'btn-primary','form-control btn ']"
                        @click="handleModalSubmitButtonClick">
                        {{ !this.formData.id ? 'Post' : 'Update' }}

                        <span v-if="isSubmitting" class="spinner-border spinner-border-sm" role="status"
                              aria-hidden="true"></span>

                </button>
            </div>
            <!-- /.card-footer -->
        </div>
    </div>
</template>

<script>
export default {
    name: 'PostCreateUpdateModal',
    props: {
        sessionData: {
            type: Object,
            default: () => {
            }
        },
        editData: {
            type: Object,
            default: () => {
            }
        }
    },
    data() {
        return {
            privacyOptions: [
                {
                    id: 1,
                    text: 'Public'
                },
                // {
                //     id: 2,
                //     text: 'Friends'
                // },
                // {
                //     id: 3,
                //     text: 'Only Me'
                // },
            ],
            formData: {
                content: '',
                privacy_id: 1,
                images: [],
            },
            isSubmitting: false,
        }
    },
    methods: {
        handleFileUpload: function () {
            const file = this.$refs.imageUploader.files[0];

            if (!file.type.includes('image')) {
                this.$toast.error("Only Image is allowed");
                this.$refs.imageUploader.value = '';
                return;
            }

            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = () => {
                this.formData.images.push({
                    image_url: reader.result,
                    file: file
                });
            }
            this.$refs.imageUploader.value = '';
        },
        removeImage: function (index) {

            //remove image when edit data
            if (this.editData && this.editData.id) {
                axios.delete(`/api/v1/images/${this.formData.images?.[index]?.id}`)
                    .then(response => {
                        this.$toast.success("Image Removed Successfully");
                    })
                    .catch(error => {
                        console.log(error);
                    })
            }

            this.formData.images.splice(index, 1);
        },
        addPost: async function () {
            this.isSubmitting = true;
            try {
                const {data: {data}} = await axios.post('/api/v1/posts/store', this.formData);
                this.$toast.success("Post Created Successfully");
                this.$emit('postCreated', data);

            } catch (error) {
                console.log(error);
            }
            this.isSubmitting = false;
        },
        updatePost: async function () {
            this.isSubmitting = true;
            try {
                const {data: {data}} = await axios.put(`/api/v1/posts/${this.formData.id}`, this.formData);
                this.$toast.success("Post Updated Successfully");
                this.$emit('postUpdated', data);

            } catch (error) {
                console.log(error);
            }
            this.isSubmitting = false;
        },
        handleModalSubmitButtonClick: function () {
            if (!this.validate()) {
                return;
            }
            if (this.formData.id) {
                this.updatePost();
                return;
            }
            this.addPost();
        },
        handleXButtonClick: function () {
            this.$emit('closeModal');
        },
        validate: function () {
            if (this.formData.content === '') {
                this.$toast.error("Post Content is required");
                return false;
            }
            return true;
        }
    },
    mounted() {
        if (this.editData && this.editData.id) {
            this.formData = this.editData;
        }
        console.log(this.editData);
    }
}
</script>

<style>

</style>
