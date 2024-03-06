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
                            <a href="{{ route('artisan-issues-show', $issue->id) }}">
                                #{{ $issue->id }} - {{ issue_sender($issue->user_id) }}
                            </a>
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
                                <span class="badge bg-light"> Me </span>
                            </h5>
                            <p>{{ $issue->description }}</p>
                            <small class="text-muted">{{ $issue->created_at->diffForHumans() }}</small>
                        </div>
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
