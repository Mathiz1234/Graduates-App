
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue');

// /**
//  * The following block of code may be used to automatically register your
//  * Vue components. It will recursively scan this directory for the Vue
//  * components and automatically register them with their "basename".
//  *
//  * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
//  */

// // const files = require.context('./', true, /\.vue$/i)
// // files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

// /**
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the page. Then, you may begin adding components to this application
//  * or customize the JavaScript scaffolding to fit your unique needs.
//  */

// const app = new Vue({
//     el: '#app'
// });

//CollapseSearchBar

$(document).ready(function(){

    let w = $( window ).width();

    if ($(window).width() >= 992){
        $('#collapseSearchBar').collapse('show');
    }

    $(window).resize(function(){
        if( w != $( window ).width() ){

            w = $( window ).width();
            if ($(window).width() >= 992){
                $('#collapseSearchBar').collapse('show');
                console.log('Show collapseSearchBar');
            }
            if ($(window).width() <= 992){
                $('#collapseSearchBar').collapse('hide');
                console.log('Hide collapseSearchBar');
            }
        }
      });
  });

//Graduate filters

$(document).ready(function(){

    let w = $( window ).width();

    function setStickyTop(){
        if ($(window).width() >= 992){
            $('.filters').addClass('sticky-top');
            console.log('Add sticky-top to filters search bar');
        }else{
            $('.filters').removeClass('sticky-top');
            console.log('Remove sticky-top to filters search bar');
        }
    }

    setStickyTop();

    $(window).resize(function(){
        setStickyTop();
    })

});

//Go-up-buttton
$(document).ready(function(){

    $(window).scroll(function() {
        if ($(this).scrollTop() >= 50) {
            $('#btn-go-up').fadeIn(200);
        } else {
            $('#btn-go-up').fadeOut(200);
        }
    });

});