@extends('layouts.front-end.app')

@section('title', translate('molecules'))

@push('css_or_js')
@endpush

@section('content')

<div class="container">

    <h2 class="mb-5 mt-3">Find medicine by molecules</h2>
    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs" id="moleculeTab" role="tablist">
        @foreach ($groupedMolecules as $letter => $molecules)
            <li class="nav-item" role="presentation">
                <button
                    class="nav-link {{ $loop->first ? 'active' : '' }} bg-info text-white"
                    id="tab-{{ $letter }}"
                    data-toggle="tab"
                    data-target="#content-{{ $letter }}"
                    type="button"
                    role="tab"
                    aria-controls="content-{{ $letter }}"
                    aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                    {{ $letter }}
                </button>
            </li>
        @endforeach
    </ul>

    <!-- Tabs Content -->
    <div class="tab-content" id="moleculeTabContent">
        @foreach ($groupedMolecules as $letter => $molecules)
            <div
                class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                id="content-{{ $letter }}"
                role="tabpanel"
                aria-labelledby="tab-{{ $letter }}">
                <ul class="list-unstyled mt-3">
                    @foreach ($molecules as $molecule)
                        <li>
                            <a href="{{ route('single-molecule', $molecule->slug) }}" target="_blank" class="text-decoration-none">
                                {{ $molecule->tag }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</div>






@endsection

@push('script')

@endpush
