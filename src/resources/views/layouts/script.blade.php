@section('script')
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script>
        window.addEventListener('load', function () {
            setTimeout(() => {
                document.getElementById('pre-loader').remove();
            }, 2 * 1000)
        });
    </script>
@endsection
