/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

window.$ = window.jQuery = require('jquery')
require('selectize');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});


$( document ).ready(function() {
    
    if( $('#input-tags').length ){ //if elemet exists
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: 'POST', // Type of response and matches what we said in the route
            url: '/ajax/tags', // This is the url we gave in the route        
            success: function(response){ // What to do if we succeed
                tags = response;          
                $('#input-tags').selectize({
                    plugins: ['remove_button'],
                    persist: false,
                    create: false,
                    maxItems: null,
                    valueField: 'id',
                    labelField: 'title',
                    searchField: 'title',
                    options: tags
                });
            },
            error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
            }
        });
    }
    
    if( $('#uploadFile').length ){ //if upload elemet exists
        $("#uploadFile").change(function(){
            $('#image_preview').html("");
            
            //var fileInput = document.getElementById('uploadFile');            
            var total_file=document.getElementById("uploadFile").files.length;
            for(var i=0;i<total_file;i++) {
                //var file = fileInput.files[i];                
                var imageName = event.target.files[i].name;
                var imgSrc = URL.createObjectURL(event.target.files[i]);
                var cnt = "<div class='row form-group imgWrappper'>\n\
                            <div class='col-md-3'><div class='imgBlock'><img src='"+imgSrc+"'></div></div>\n\
                            <input type='hidden' name='images["+i+"][name]' value='"+imageName+"' />\n\
                            <div class='inputBlock col-md-9'>\n\
                                <div class='form-group row'>\n\
                                    <div class='col-md-6'><input name='images["+i+"][title]' class='title form-control' type='text' placeholder='Title'/></div>\n\
                                    <div class='col-md-6'><input name='images["+i+"][alt]' class='alt form-control' type='text' placeholder='Alt' /></div>\n\
                                </div>\n\
                                <div class='form-group row'>\n\
                                    <div class='col-md-9'><input name='images["+i+"][caption]' class='caption form-control' type='text' placeholder='Caption' /></div>\n\
                                    <div class='col-md-3'><input name='images["+i+"][order]' class='order form-control' type='number' min='1' step='1' placeholder='Order' value='"+(i+1)+"' /></div>\n\
                                </div>\n\
                                <div class='form-group row'>\n\
                                    <div class='col-md-12'><textarea name='images["+i+"][description]' class='form-control' placeholder='Description'></textarea></div>\n\
                                </div>\n\
                            </div>\n\
                          </div>";
                $('#image_preview').append(cnt);
            }
        });
//        <span class='remove'>X</span>
        $('#image_preview').on('click', '.imgWrappper .remove', function() {
            $(this).closest("div.imgWrappper").remove();
        });
    }
    
   
});