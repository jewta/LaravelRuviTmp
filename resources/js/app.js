
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./jquery.maskedinput.js');
require('./password-generator.js');
require('./ckeditor.js');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/**
 * Скрипт админки
 */
(function () {
    "use strict";

    var treeviewMenu = $('.app-menu');

    // Toggle Sidebar
    $('[data-toggle="sidebar"]').click(function(event) {
        event.preventDefault();
        $('.app').toggleClass('sidenav-toggled');
    });

    // Activate sidebar treeview toggle
    $("[data-toggle='treeview']").click(function(event) {
        event.preventDefault();
        if(!$(this).parent().hasClass('is-expanded')) {
            treeviewMenu.find("[data-toggle='treeview']").parent().removeClass('is-expanded');
        }
        $(this).parent().toggleClass('is-expanded');
    });

    // Set initial active toggle
    $("[data-toggle='treeview.'].is-expanded").parent().toggleClass('is-expanded');

    //Activate bootstrip tooltips
    $("[data-toggle='tooltip']").tooltip();
})();

/**
 * Мой скрипт
 */
(function () {
    "use strict";

    /**
     * Маска для инпута ввода телефона
     */
    $("#phone").mask("+7(999) 999-99-99");

    /**
     * Генерация пароля для страницы добавление пользователей
     */
    $('#generate_password').on('click', function(e){
        e.preventDefault();

        let password = $.password_generator({
            count: 8,
            digits: true,
            upper: false,
            lower: true,
            special: false
        });

        $('#password').val(password);
        $('#password-confirm').val(password);
    });

    /**
     * Когда загружаем фото, меняется цвет инпута и подставляется название файла
     */
    $('.custom-file-input').each(function(){
        $(this).change(function(e){
            var file = e.target.files[0];

            $(this).next('.custom-file-label').text(file.name).addClass('text-success');

            $(this).addClass('is-valid');
        });
    });

    /**
     * Подставляет путь до паспорта в модалку
     */
    $(document).on('click touchstart', '.img_url', function(e){
        e.preventDefault();

        let img = $(this).data('img');
        let name = $(this).data('name');

        $('#imgModalLabel').text(name);
        $('#img_src').attr({
            'src': img,
            'alt': name
        });
    });

    /**
     * Открывает инпуты добавления в seo
     */
    $('#add_seo').change(function(){
        if($(this).prop('checked')){
            $('#collapse_seo').collapse('show');
            $('#seo_title').attr('name', 'seo_title');
            $('#seo_keywords').attr('name', 'seo_keywords');
            $('#seo_description').attr('name', 'seo_description');
        }
        else{
            $('#collapse_seo').collapse('hide');
            $('#seo_title').attr('name', '');
            $('#seo_keywords').attr('name', '');
            $('#seo_description').attr('name', '');
        }
    });

    /**
     * Объект для кнопок удалить, активировать, деактивировать
     */
    let Action = {

        act: function(element, method){
            element.on('click', function (e) {
                e.preventDefault();

                let href = $(this).attr('href');

                $.post(href, {
                    _method: method,
                    _token: $('meta[name="csrf-token"]').attr('content')
                }, function(data){
                    location.reload();
                });
            });
        },
    };

    $('.delete').each(function () {
        Action.act($(this), 'DELETE');
    });

    $('.activate').each(function () {
        Action.act($(this), 'POST');
    });

    $('.deactivate').each(function () {
        Action.act($(this), 'POST');
    });

})();


