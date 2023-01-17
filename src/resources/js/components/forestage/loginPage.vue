<template>
    <div class="page">
        <div class="content" id="userRegister">
            <div class="field" id="userRegisterField">
                <h3 class="title">登入</h3>
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
                    <div class="col-auto ms-1">
                        <input type="checkbox" class="form-check-input" id="rememberMe" v-model="rememberMe" />
                    </div>
                    <div class="col-auto ps-0">
                        <label for="rememberMe" class="col-form-label">記住我</label>
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
    name: 'LoginPage',
    components: {
        AlertModal: alertModal,
    },
    data() {
        return {
            api: '/api/login',
            username: '',
            password: '',
            rememberMe: false,
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
            this.rememberMe = false;
        },
        checkUsername() {
            if (this.username.length < 1) {
                MyFuncs.alert(this, '警告', '未輸入帳號');
                throw new MyExcps.FormException(1, 'No username');
            }
        },
        checkPassword() {
            if (this.password.length < 1) {
                MyFuncs.alert(this, '警告', '未輸入密碼');
                throw new MyExcps.FormException(2, 'No password');
            }
        },
        sendRequest() {
            axios({
                method: 'post',
                url: this.api,
                data: {
                    name: this.username,
                    password: this.password,
                    rememberMe: this.rememberMe,
                },
            })
                .then(response => {
                    console.log(response);
                    // if (response.data.status === 'success') {
                    //     MyFuncs.alert(this, '註冊成功', '請重新登入');
                    //     this.$router.push('/login');
                    // } else {
                    //     MyFuncs.alert(this, '註冊失敗', response.data.message);
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
                        MyFuncs.alert(this, '登入失敗', errorMessage);
                    } else {
                        MyFuncs.alert(this, '登入失敗', '意料外的錯誤');
                    }
                });
        },
    },
};
</script>

<style scoped lang="scss"></style>
