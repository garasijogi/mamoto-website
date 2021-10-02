@extends('layouts.app')
@section('title', 'Mamoto Picture - FAQ')
@section('content')
<div class="al-container d-block al-wing-bg al-min-height-25">
    <div class="container">
        <div class="mt-5 text-center ns-faq-title ">
            <h1 class="ns-title">Frequently Asked Question</h1>
        </div>
        <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-12"></div>
            <div class="col-lg-10 col-md-10 col-sm-12">

                <div class="ns-faq-list">
                    @foreach ($faq as $item)
                        <div class="row">
                            <div class="col-11">
                                <p class="mb-0 ns-question">{{ $item->question }}</p>
                            </div>
                            <button type="button" class="ns-button collapsible"><i class="fas fa-plus"></i></button>
                            <div class="ns-content col-12">
                                <div class="d-flex justify-content-center" id="ns-spinner">
                                    <div class="spinner-border" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                                <p class="ns-answer">{{ $item->answer }}</p>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>

            </div>
            <div class="col-lg-1 col-md-1 col-sm-12"></div>
        </div>
    </div>
</div>
@endsection