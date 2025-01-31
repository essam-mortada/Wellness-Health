@include('admin.layouts.header')

<div class="container">
    <h2>News Bar</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('news-bar.update') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="content">News Bar Content:</label>
            <textarea id="content" name="content" class="form-control" required>{{ old('content', $newsBar?->content) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Save</button>
    </form>
</div>

@include('admin.layouts.scripts')
