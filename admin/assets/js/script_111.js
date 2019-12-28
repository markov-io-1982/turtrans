//Dynamic Datepicker Fields
$('body').on('focus', ".for-items-datepicker", function () {
    $(this).datepicker();
});

$('.for-items-datepicker').datepicker({
    language: 'uk',
    dateFormat: ' ',
    timepicker: true,
    classes: 'only-timepicker'
})


//Clone the hidden element and shows it
$('.add-one').click(function () {
    $('.dynamic-element').first().clone().appendTo('.dynamic-stuff').show();
    attach_delete();
});


//Attach functionality to delete buttons
function attach_delete() {
    $('.delete').off();
    $('.delete').click(function () {
        console.log("click");
        $(this).closest('.form-group').remove();
    });
}


/* Dynamic 2*/

//Clone the hidden element and shows it
$('.add-one-discount').click(function () {
    $('.dynamic-element-discount').first().clone().appendTo('.dynamic-stuff-discount').show();
    attach_delete();
});


//Attach functionality to delete buttons
function attach_delete() {
    $('.delete-discount').off();
    $('.delete-discount').click(function () {
        console.log("click");
        $(this).closest('.form-group').remove();
    });
}

/* Dynamic 2*/

/* Dynamic 3 bus*/

//Clone the hidden element and shows it
$('.add-one-bus').click(function () {
    $('.dynamic-element-bus').first().clone().appendTo('.dynamic-stuff-bus').show();
    attach_delete();
});


//Attach functionality to delete buttons
function attach_delete() {
    $('.delete-bus').off();
    $('.delete-bus').click(function () {
        console.log("click");
        $(this).closest('.form-group').remove();
    });
}



//Dynamic Datepicker Fields
$('body').on('focus', ".date-datepicker3", function () {
    $(this).datepicker2();
});

$('.date-datepicker3').datepicker3({
    multidate: true,
    format: 'dd-mm-yyyy'
});


