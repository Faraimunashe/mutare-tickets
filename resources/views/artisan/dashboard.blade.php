<x-app-layout>
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div>
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Faults</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-card-text"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>
                                            <a href="{{ route('artisan-issues') }}">{{ \App\Models\Issue::join('allocateds', 'allocateds.issue_id', '=', 'issues.id')->where('allocateds.user_id', Auth::id())->count() }}</a>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Pending Faults</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-card-list"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>
                                            <a href="{{ route('artisan-issues', ['status'=>'pending']) }}">{{ \App\Models\Issue::join('allocateds', 'allocateds.issue_id', '=', 'issues.id')->where('allocateds.user_id', Auth::id())->where('status', 'pending')->count() }}</a>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Solved Faults</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-card-checklist"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>
                                            <a href="{{ route('artisan-issues', ['status'=>'solved']) }}">{{ \App\Models\Issue::join('allocateds', 'allocateds.issue_id', '=', 'issues.id')->where('allocateds.user_id', Auth::id())->where('status', 'solved')->count() }}</a>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
