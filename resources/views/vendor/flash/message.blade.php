<script>
    @foreach (session('flash_notification', collect())->toArray() as $message)
    flash('{{$message['message']}}','{{ $message['level'] }}');
    @endforeach
</script>
{{ session()->forget('flash_notification') }}
