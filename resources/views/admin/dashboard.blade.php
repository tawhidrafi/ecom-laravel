<form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
    @csrf
    <button type="submit" class="btn btn-link">Logout</button>
</form>