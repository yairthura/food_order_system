$(document).ready(function() {
    //+ button function
    $('#btn-plus').click(function() {
        $parentNode = $(this).parents("tr");
        $price = Number($parentNode.find('#price').text().replace("kyats",""));
        $qty = Number($parentNode.find('#qty').val());
        $total = $price * $qty;
        console.log($total);
        $parentNode.find('#total').html($total+" kyats");
        // total summary
        summary();

    })
    // - button function
    $('#btn-minus').click(function() {
        $parentNode = $(this).parents("tr");
        $price = Number($parentNode.find('#price').text().replace("kyats",""));
        $qty = Number($parentNode.find('#qty').val());
        $total = $price * $qty;
console.log($total);
        $parentNode.find('#total').html($total+" kyats");
        summary();
    })
    //remove button
    $('.btnRemove').click(function() {
        $parentNode = $(this).parents("tr");
        $parentNode.remove();
        summary();
    })

    function summary() {
        $totalPrice = 0;

        $('dataTable tr').each(function(index, row) {
            $totalPrice += Number($(row).find('#total').text().replace("kyats", ""));
        });
        $('#subTotalPrice').html(`${$totalPrice} kyats`);
        $('#finalPrice').html(`${$totalPrice + 3000} kyats`);


    }
})
