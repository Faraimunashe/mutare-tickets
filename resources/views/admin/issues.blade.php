<x-app-layout>
    <div class="pagetitle">
        <h1>Issues</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Issues</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row">
            <x-alert/>
            @foreach ($issues as $issue)
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('admin-issues-show', $issue->id) }}">
                                #{{ $issue->id }} - {{ issue_sender($issue->user_id) }}
                            </a>
                            <button class="btn btn-sm btn-primary" style="float: right;" data-bs-toggle="modal" data-bs-target="#allocate{{$issue->id}}">Allocate</button>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">
                                {{ $issue->title }}
                                @if ($issue->status == 'solved')
                                    <span class="badge bg-success text-dark">
                                        <i class="bi bi-check-circle me-1"></i> {{ $issue->status }}
                                    </span>
                                @else
                                    <span class="badge bg-info text-dark">
                                        <i class="bi bi-info-circle me-1"></i> {{ $issue->status }}
                                    </span>
                                @endif
                                <span class="badge bg-dark">{{ get_assigned_artisan($issue->id) }}</span>
                            </h5>
                            <p>{{ $issue->description }}</p>
                            <small class="text-muted">{{ $issue->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="allocate{{$issue->id}}" tabindex="-1" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <form class="modal-content" action="{{ route('admin-allocate') }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Assign An Artisan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="issue_id" value="{{ $issue->id }}" required>
                                <div class="col-md-12">
                                    <label for="inputState" class="form-label">Choose Artisan</label>
                                    <select id="inputState" name="artisan_id" class="form-select" required>
                                        <option selected disabled>Choose Artisan</option>
                                        @foreach ($artisans as $artisan)
                                            <option value="{{ $artisan->id }}">{{ $artisan->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
            <div class="col-12">
                {{ $issues->links('pagination::bootstrap-5') }}
            </div>
            @if ($issues->isEmpty())
                <div class="col-12">
                    <div class="alert alert-dark" role="alert">
                        You haven't reported any issue/faulty at the moment!
                    </div>
                </div>
            @endif
        </div>
    </section>
</x-app-layout>
