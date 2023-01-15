import _ from 'lodash';
window._ = _;

import * as Bootstrap from 'bootstrap';
window.Bootstrap = Bootstrap;

import * as Vue from 'vue';
window.Vue = Vue;

import Vuex from 'vuex';
window.Vuex = Vuex;

import * as VueRouter from 'vue-router';
window.VueRouter = VueRouter;

import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import myDefs from './mylib/definitions';
window.MyDefs = myDefs;

import myFuncs from './mylib/functions';
window.MyFuncs = myFuncs;

import myExcps from './mylib/exceptions';
window.MyExcps = myExcps;
