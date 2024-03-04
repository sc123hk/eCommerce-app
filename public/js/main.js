$(document).ready(function() {
    $.ajaxSetup({
        headers:
        { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });
});

$('.item-quantity').change(function (e) { 
    e.preventDefault();
    const id = $(this).attr('name');
    const quantity = $(this).val();
    if (quantity >= 0 && quantity < 10) {
        $.ajax({
            type: "POST",
            url: "/cart",
            data: {"id": id, "quantity": quantity},
            success: function (response) {
                if (response['delete']) {
                    location.reload();
                }
            }
        });
    } else {
        alert('Invalid input!');
        $(this).val(1);
    }
});

$('#showProductBtn').click(function (e) { 
    e.preventDefault();
    title = $('#showTitle option:selected').text();
    $.ajax({
        type: "GET",
        url: '/admin',
        data: {"title": title},
        success: function (response) {
            $('#showCategory').val(response['category']);
            $('#showDescription').val(response['description']);
            $('#showPrice').val(response['price']);
            $('#showQuantity').val(response['quantity']);
        }
    });
});