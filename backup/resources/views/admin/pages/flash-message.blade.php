@if ($message = Session::get('success'))
    <script>
        showNotificationModal('{{ $message }}','alert-success',"top","right");
    </script>
@endif


@if ($message = Session::get('error'))
    <script>
        showNotificationModal('{{ $message }}','alert-danger',"top","right");
    </script>
@endif


@if ($message = Session::get('warning'))
    <script>
        showNotificationModal('{{ $message }}','alert-warning',"top","right");
    </script>
@endif

@if ($message = Session::get('info'))
    <script>
        showNotificationModal('{{ $message }}','alert-info',"top","right");
    </script>
@endif


@if ($errors->any())
    @foreach ($errors->all() as $error)
    <script>
        showNotificationModal('{{ $error }}','bg-red',"top","right");
    </script>
    @endforeach
@endif
