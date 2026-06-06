<form action="{{ route('logout') }}" method="post">
    @csrf
    <button type="submit" class="btn btn--secondary">
        <x-svg.logout />
        {{ ucfirst(__('form-labels.logout')) }}
    </button>
</form>
