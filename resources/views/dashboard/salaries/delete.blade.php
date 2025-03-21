<form action="{{ route('salaries.destroy', $salary->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm">
        <i class="fas fa-trash"></i> delete
    </button>
</form>
