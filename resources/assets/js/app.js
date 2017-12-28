
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

$(function() {
    console.log('loaded');

    //$('iframe.video').

    $('.video-info-wrapper .nav-tabs .nav-item').on('click', function(e) {
        function loadTab(id) {
            $('.video-info-wrapper .content-wrapper').children().hide();
            $('.video-info-wrapper .content-wrapper #' + id).show();
        }

        e.preventDefault();
        e.stopPropagation();

        // load tab
        var tabId = $(this).data('tab-id');
        loadTab(tabId);

        // change active tab
        $('.video-info-wrapper .nav-tabs .nav-item .nav-link').removeClass('active');
        $(this).children('.nav-link').addClass('active');
    });
});

//window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example', require('./components/Example.vue'));
//
// const app = new Vue({
//     el: '#app'
// });
