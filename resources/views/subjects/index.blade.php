@extends('layouts.app')

@section('title', 'Subjects')

@section('content')

    <form method="GET" action="{{ route('subjects.index') }}">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search subject..."
        >

        <select name="sort">
            <option value="code" @selected($sort === 'code')>
                Sort by code
            </option>
            <option value="units" @selected($sort === 'units')>
                Sort by units
            </option>
        </select>

        <button type="submit">Apply</button>

        <a href="{{ route('subjects.index') }}">Clear</a>
    </form>

    @can('create', App\Models\Subject::class)
        <div class="mb-3">
            <a href="{{ route('subjects.create') }}" class="btn btn-primary">
                Add Subject
            </a>
        </div>
    @endcan

    @cannot('create', App\Models\Subject::class)
        <p class="text-muted small">You are viewing this list in read-only mode.</p>
    @endcannot

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Subject Code</th>
                        <th>Subject Title</th>
                        <th class="text-center">Units</th>
                        <th>Category</th>

                        @can('create', App\Models\Subject::class)
                            <th class="text-center">Actions</th>
                        @endcan
                    </tr>
                </thead>

                <tbody>
                    @forelse ($subjects as $subject)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $subject->code }}</td>
                            <td>{{ $subject->subject }}</td>
                            <td class="text-center">{{ $subject->units }}</td>
                            <td>
                                <span class="badge bg-info">
                                    {{ $subject->category->name }}
                                </span>
                            </td>

                            @can('create', App\Models\Subject::class)
                                <td class="text-center">
                                    @can('update', $subject)
                                        <a href="{{ route('subjects.edit', $subject->id) }}"
                                           class="btn btn-warning btn-sm">
                                            Edit
                                        </a>
                                    @endcan

                                    @can('delete', $subject)
                                        <form action="{{ route('subjects.destroy', $subject->id) }}"
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Do you want to delete this subject?')">
                                                Delete
                                            </button>
                                        </form>
                                    @endcan
                                </td>
                            @endcan
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-5">
                                No subjects found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $subjects->links() }}
        </div>
    </div>

@endsection