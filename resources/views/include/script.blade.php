<script src="{{asset('admin_assets/assets/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('admin_assets/assets/js/bootstrap.bundle.5.1.3.min.js')}}"></script>
<script src="{{asset('admin_assets/assets/js/instantpages.5.1.0.min.js')}}"></script>
<script src="{{asset('admin_assets/assets/js/lazyload.17.6.0.min.js')}}"></script>
<script src="{{asset('admin_assets/assets/js/slick.min.js')}}"></script>
<script src="{{asset('admin_assets/assets/js/lightbox.min.js')}}"></script>
<script src="{{asset('admin_assets/assets/js/custom.js')}}"></script>


<script>
    $.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
});
</script>
@yield('script')