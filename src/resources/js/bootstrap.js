import _ from 'lodash';
window._ = _;

import 'bootstrap';

import * as Vue from 'vue';
window.Vue = Vue;

import Vuex from 'vuex';
window.Vuex = Vuex;

import * as VueRouter from 'vue-router';
window.VueRouter = VueRouter;

import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
