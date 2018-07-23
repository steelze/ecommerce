<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/popper.js/umd/popper.min.js') }}"> </script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/owl.carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('vendor/nouislider/nouislider.min.js') }}"></script>
<!-- Main Template File-->
<script src="{{ asset('js/front.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script>
    function addSingleToCart(params) {
        let url = "{{ url('add-to-cart') }}";
        url = `${url}/${params}`
        $.get(url, function(data){
            refreshHeader();
        });

    }

    function removeSingleFromCart(params) {
        let url = "{{ url('remove-from-cart') }}";
        url = `${url}/${params}`
        $.get(url, function(data){
            refreshHeader();
        });
    }
    
    function addMultipleToCart(params) {
        let quantity = document.getElementById('quantity-no');
        if (quantity.value == '') return false;
        if (parseInt(quantity.value) > parseInt(quantity.getAttribute('max'))) return false;
        const data = {
            id: params,
            qty: quantity.value
        }
        $.get("{{ route('product.multiple.cart') }}", data, function(response){
            refreshHeader();
        });
    }
</script>
@section('link-js')
@show