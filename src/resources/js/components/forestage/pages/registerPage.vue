<template>
    <div class="page">
        <div class="content" id="userRegister">
            <div class="field" id="userRegisterField">
                <h3 class="title">使用者註冊</h3>
                <div class="row align-items-center form mb-2">
                    <div class="col form-title">
                        <label for="username" class="col-form-label">帳號</label>
                    </div>
                    <div class="col form-content">
                        <input type="text" class="form-control" id="username" v-model="username" />
                    </div>
                </div>
                <div class="row align-items-center form mb-2">
                    <div class="col form-title">
                        <label for="password" class="col-form-label">密碼</label>
                    </div>
                    <div class="col form-content">
                        <input type="password" class="form-control" id="password" v-model="password" />
                    </div>
                </div>
                <div class="row align-items-center form mb-2">
                    <div class="col form-title">
                        <label for="confirmPassword" class="col-form-label">確認密碼</label>
                    </div>
                    <div class="col form-content">
                        <input type="password" class="form-control" id="confirmPassword" v-model="password2" />
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-positive btn-submit me-2" @click="submit">送出</button>
                    <button type="button" class="btn btn-negative btn-reset" @click="reset">清空</button>
                </div>
            </div>
        </div>
        <alert-modal :title="alert.title" :content="alert.content"></alert-modal>
    </div>
</template>

<script>
import alertModal from '@/js/components/common/alertModal.vue';

export default {
    name: 'RegisterPage',
    components: {
        AlertModal: alertModal,
    },
    data() {
        return {
            api: '/api/user/add',
            username: '',
            password: '',
            password2: '',
            alert: {
                title: '警告',
                content: ['帳號或密碼錯誤'],
            },
        };
    },
    methods: {
        submit() {
            try {
                this.checkUsername();
                this.checkPassword();
                this.sendRequest();
            } catch (error) {
                if (error instanceof MyExcps.FormException) {
                    console.warn(error.message);
                } else {
                    console.error(error.message);
                }
            }
        },
        reset() {
            this.username = '';
            this.password = '';
            this.password2 = '';
        },
        checkUsername() {
            if (this.username.length < 1) {
                this.$root.alert('警告', '未輸入帳號');
                throw new MyExcps.FormException(1, 'No username');
            }
        },
        checkPassword() {
            if (this.password.length < 1 && this.password2.length < 1) {
                this.$root.alert('警告', '未輸入密碼');
                throw new MyExcps.FormException(2, 'No password');
            } else if (this.password !== this.password2) {
                this.$root.alert('警告', '密碼不一致');
                throw new MyExcps.FormException(3, 'Password not match');
            }
        },
        sendRequest() {
            axios({
                method: 'post',
                url: this.api,
                data: {
                    username: this.username,
                    password: this.password,
                },
            })
                .then(response => {
                    console.log(response);
                    // if (response.data.status === 'success') {
                    //     this.$root.alert('註冊成功', '請重新登入');
                    //     this.$router.push('/login');
                    // } else {
                    //     this.$root.alert('註冊失敗', response.data.message);
                    // }
                })
                .catch(error => {
                    if (error.response && error.response.data && error.response.data.data) {
                        const errorData = error.response.data.data;
                        let errorMessage = [];
                        Object.keys(errorData).forEach(key => {
                            errorData[key].forEach(value => {
                                errorMessage.push(value);
                            });
                        });
                        this.$root.alert('使用者註冊失敗', errorMessage);
                    } else {
                        this.$root.alert('使用者註冊失敗', '意料外的錯誤');
                    }
                });
        },
    },
};
</script>

<style scoped lang="scss"></style>
