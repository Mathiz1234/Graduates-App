
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

//Tooltips
$(document).ready(function(){
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
});

//Create view
$(document).ready(function() {

    let checkboxID = 0;

    $(".addFormButton").click(function(){
        let path = $(".increment").find('input').val();
        if(path!='')
        {
            let content = $("#clone>div").clone();
            let input = $(".increment").find('input').clone();

            content.closest('div').prepend(input);
            content.insertAfter(".increment");

            $(".increment").find('input').val('');

            content.find('.insideCheckboxDiv>input').attr('id','insideCheckbox'+checkboxID);
            content.find('.insideCheckboxDiv>label').attr('for','insideCheckbox'+checkboxID);

            content.find('.insideCheckboxDiv>input').attr('name','scansShared['+checkboxID+']');

            content.closest('div').find('input[type=file]').attr('name','scans['+checkboxID+']');

            checkboxID++;

            console.log('add file');

            content.find('button').first().click(function(){
                console.log('remove file');
                $(this).parents(".control-group").remove();
            });
        }
    });
});

//Delete avatar button
$(document).ready(function(){

    $('#delete_avatar').click(function(){
        $('html').css('scroll-behavior', 'auto');
        $(this).next('input').attr('value', 'true');
        $('#old-avatar-section').hide('fast', function(){
            $('#new-avatar-section').show();
            setTimeout(function(){
                $('html').css('scroll-behavior', 'smooth');
            }, 1000);
        });
    });

});

//Delete files button
$(document).ready(function(){

    $('.files-delete-button').click(function(){
        $('html').css('scroll-behavior', 'auto');
        $(this).next('input').attr('value', 'false');
        $(this).parent().hide('fast', function(){
            setTimeout(function(){
                $('html').css('scroll-behavior', 'smooth');
            }, 1000);
        });
    });

});

//Delete scans button
$(document).ready(function(){

    $('.graduate-card_img--delete').click(function(e){
        e.preventDefault();
        $('html').css('scroll-behavior', 'auto');
        $(this).next('input').attr('value', 'false');
        $(this).parents('.graduate-card__container').hide('fast', function(){
            setTimeout(function(){
                $('html').css('scroll-behavior', 'smooth');
            }, 1000);
        });
    });

});

//Checkbox while editing
$(document).ready(function(){

    const mainShareCheckbox = $('#ifShared');


    if(mainShareCheckbox.length > 0){


        function checkEditingbox(e){
            if(!this.checked) {
                $('input[type=checkbox]').prop('checked', false).prop('disabled', true);
                $(e.target).prop('disabled', false);
            }else{
                $('input[type=checkbox]').prop('checked', true).prop('disabled', false);
            }
            $('#insideCheckbox').prop('checked', false);
        }

        if(!mainShareCheckbox.is(':checked')){
            $('input[type=checkbox]').prop('checked', false).prop('disabled', true);
            mainShareCheckbox.prop('disabled', false);
            $('#insideCheckbox').prop('checked', false);
        }

        mainShareCheckbox.on('change', checkEditingbox);

    }

});