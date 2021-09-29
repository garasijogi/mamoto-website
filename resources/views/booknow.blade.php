@extends('layouts.app')
@section('title', 'Mamoto Picture - Book Now!')
@section('content')

<div class="container al-mt-container">
    <div class="row">
        <div class="col-lg-2 col-md-1 col-sm-12"></div>
        <div class="col-lg-8 col-md-10 col-sm-12">
            <div class="card ns-card mb-5">
                <div class="container p-5">
                    <div class="ns-book-head text-center">
                        <h1 class="ns-title">Book Now</h1>
                        <h6 class="ns-title">Let's Talk About your Moment</h6>
                    </div>
                    <div class="container-fluid col-lg-10 mt-5">
                        {{-- <form action="/booknow/book" method="post" class="ns-font-form"> --}}
                        <form id="formBookNow" action="#" method="post" class="ns-font-form" novalidate>
                            {{-- Full Name --}}
                            <div class="form-group">
                                <label for="" class="ns-label">Full Name</label>
                                <input type="text" class="form-control form-control-lg ns-form"
                                    placeholder="Please Write your Full Name" name="name">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- No Handphone --}}
                            <div class="form-group">
                                <label for="" class="ns-label">Handphone Number</label>
                                <input type="text" class="form-control form-control-lg ns-form"
                                    placeholder="Please Enter your Phone Number" name="phone">
                                @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- Email --}}
                            <div class="form-group">
                                <label for="" class="ns-label">E-Mail</label>
                                <input type="email" class="form-control form-control-lg ns-form"
                                    placeholder="Please Enter your email" name="email">
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- Type of Events [OLD] --}}
                            {{-- <div class="form-group">
                                <label for="" class="ns-label">Type Of Event <sup>*Full Package harap checklist
                                        semua
                                        kotak</sup></label> <br>
                                @foreach ($events as $event)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="{{ $event->id }}"
                                        value="{{ $event->name }}" name="event[{{ $event->id }}]">
                                    <label class="form-check-label" for="{{ $event->id }}">{{ $event->name }}</label>
                                </div>
                                @endforeach
                                @error('events')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div> --}}
                            {{-- pilih paket form --}}
                            <div class="form-group">
                                <label for="" class="ns-label">Pilih Paket</label>
                                {{-- <input type="text" class="form-control form-control-lg ns-form" placeholder="Please choose your package" name="pilih_paket"> --}}
                                <select class="custom-select custom-select-lg form-control  ns-form" placeholder="Please choose your package" name="pilih_paket">
                                    <option value="" >Please choose your package</option>
                                    @foreach ($books_packages as $books_package)
                                        <option value="{{ $books_package['id'] }}" >{{ $books_package['name_product'] }}</option>
                                    @endforeach
                                </select>
                                @error('pilih_paket')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- Pilih kisaran harga form --}}
                            <div class="form-group">
                                <label for="" class="ns-label">Kisaran Budget</label>
                                <select class="custom-select custom-select-lg form-control  ns-form" placeholder="Estimate your budget"
                                    name="kisaran_budget" disabled="true">
                                    <option value="" >Estimate your budget</option>
                                </select>
                                @error('kisaran_budget')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- Booking Date --}}
                            <div class="form-group">
                                <label for="" class="ns-label">Booking Date</label>
                                <input placeholder="Please Select the Booking Date"
                                    class="textbox-n form-control form-control-lg ns-form" type="text"
                                    onfocus="(this.type='date')" name="booking_date">
                                @error('booking_date')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- Location --}}
                            <div class="form-group">
                                <label for="" class="ns-label">Location</label>
                                <textarea placeholder="Please write the full location to venue"
                                    class="textbox-n form-control form-control-lg ns-form" rows="3"
                                    name="location"></textarea>
                                @error('location')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- Note --}}
                            <div class="form-group">
                                <label for="" class="ns-label">Note <sup>*Optional</sup></label>
                                <textarea placeholder="Write an additional information"
                                    class="textbox-n form-control form-control-lg ns-form" rows="3"
                                    name="note"></textarea>
                            </div>
                        <button type="submit" class="btn mb-2 px-5 mx-auto d-block ns-submit" >Book Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-1 col-sm-12"></div>
    </div>
</div>
<input type="hidden" name="books_packages" value="{{ json_encode($books_packages) }}">
<input type="hidden" name="contact_wa" value="{{ json_encode($contact_wa) }}">
@endsection

@section('js-ryu')
{{-- jquery validate --}}
<script src="{{ asset('js/admin/jquery-validate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/admin/jquery-validate/additional-methods.min.js') }}"></script>
{{-- booknow script --}}
<script src="{{ asset('js/booknow.js') }}"></script>
@endsection
