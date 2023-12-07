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
                        <label for="rememberMe" class="col-form-label">記住我1111</label>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-positive btn-submit me-2" @click="submit">送出</button>
                    <button type="button" class="btn btn-negative btn-reset" @click="reset">清空</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: 'LoginPage',
    data() {
        return {
            api: '/api/login',
            homePage: '/',
            username: '',
            password: '',
            rememberMe: false,
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
                this.$root.alert('警告', '未輸入帳號');
                throw new MyExcps.FormException(1, 'No username');
            }
        },
        checkPassword() {
            if (this.password.length < 1) {
                this.$root.alert('警告', '未輸入密碼');
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
                    if (response.data && response.data.data && response.data.data.jwt && response.data.data.player_tokens) {
                        localStorage.setItem('Token', response.data.data.jwt.access_token);
                        localStorage.setItem('PlayerTokens', JSON.stringify(response.data.data.player_tokens));
                        let nextPage = localStorage.getItem('From') || this.homePage;
                        this.$router.push(nextPage);
                    }
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
                        this.$root.alert('登入失敗', errorMessage);
                    } else {
                        this.$root.alert('登入失敗', '意料外的錯誤');
                    }
                });
        },
    },
};
</script>

<style scoped lang="scss"></style>
