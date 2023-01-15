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
            username: '',
            password: '',
            password2: '',
            alert: {
                title: '警告',
                content: '帳號或密碼錯誤',
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
                MyFuncs.alert(this, '警告', '未輸入帳號');
                throw new MyExcps.FormException(1, 'No username');
            }
        },
        checkPassword() {
            if (this.password.length < 1 && this.password2.length < 1) {
                MyFuncs.alert(this, '警告', '未輸入密碼');
                throw new MyExcps.FormException(2, 'No password');
            } else if (this.password !== this.password2) {
                MyFuncs.alert(this, '警告', '密碼不一致');
                throw new MyExcps.FormException(3, 'Password not match');
            }
        },
        sendRequest() {
            console.log('Send request');
        },
    },
};
</script>

<style scoped lang="scss">
.col {
    &.form-title {
        width: 12%;
    }

    &.form-content {
        width: 88%;
    }
}
</style>
