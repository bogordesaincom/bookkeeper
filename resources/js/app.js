
/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

require('./bootstrap');
require('./vendor/modernizr.min');
require('./modules/all');
require('flatpickr');
require('flatpickr/dist/l10n/tr.js');

// NOTIFICATIONS
$('.notification > button.delete').click(function(e) {
    e.preventDefault();
    $(this).parent().hide();
});

// BURGER NAVIGATION
$('.navbar-burger').click(function() {
    $('.navbar-burger').toggleClass('is-active');
    $('.navbar-menu').toggleClass('is-active');
});

// DELETE MODAL
var deleteModal = $('#deleteModal'),
    deleteForm = $('#deleteForm'),
    deleteMessage = $('#deleteMessage');

$('#app').on('click', 'a.delete-option', function(e) {
    e.preventDefault();
    e.stopPropagation();

    var item = $(e.target);

    deleteModal.addClass('is-active');
    deleteForm.attr('action', item.attr('href'));
    deleteMessage.text(item.data('message'));
});

$('.is-dismiss').click(function(e) {
    e.preventDefault();
    e.stopPropagation();

    deleteModal.removeClass('is-active');
    deleteForm.attr('action', '#');
});

// PASSWORD FIELDS
$('.control--password').each(function () {
    new PasswordMeter($(this));
});

// DATE FIELDS
$('.datetime').each(function() {
    $(this).flatpickr({
        enableTime: true,
        dateFormat:'Y-m-d H:i:S',
        locale: window.locale
    });
});

// FILE FIELDS
$('.file').each(function() {
    var el = $(this),
        input = el.find('input.file-input'),
        name = el.find('span.file-name');

    input.change(function() {
        var namePieces = input.val().split('\\');
        name.text(namePieces[namePieces.length -1]);
    });
});

// RELATION FIELDS
$('.relation').each(function() {
    var relation = new Relation($(this));
});
