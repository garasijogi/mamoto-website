@extends('layouts.app')
@section('title', 'Mamoto Picture - Book Now!')
@section('content')
    <div class="container">
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
                            <form action="/order/book" method="post" class="ns-font-form">
                                @csrf
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
                                {{-- Type of Events --}}
                                <div class="form-group">
                                    <label for="" class="ns-label">Type Of Event <sup>*Full Package harap checklist semua
                                            kotak</sup></label> <br>
                                    @foreach ($events as $event)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="{{ $event->id }}"
                                                value="{{ $event->name }}" name="event[{{ $event->id }}]">
                                            <label class="form-check-label"
                                                for="{{ $event->id }}">{{ $event->name }}</label>
                                        </div>
                                    @endforeach
                                    @error('events')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- Booking Date --}}
                                <div class="form-group">
                                    <label for="" class="ns-label">Booking Date</label>
                                    <input placeholder="Please Select the Booking Date"
                                        class="textbox-n form-control form-control-lg ns-form datepicker" type="text"
                                        name="booking_date">
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
                                <button type="submit" class="btn mb-2 px-5 mx-auto d-block ns-submit">Book Now</button>
                            </form>

                            <h5 class="text-center mt-4"><b>We will contact you back soon after you fill out the form</b>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-1 col-sm-12"></div>
        </div>
    </div>
@endsection
