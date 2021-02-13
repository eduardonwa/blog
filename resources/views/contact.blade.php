@extends('layouts.app')

@section('modernizr')
    <script src="js/modernizr.custom.80028.js"></script>
@endsection

@section('content')

<form class="contact-form" method="POST" action="/contact">
    @csrf

    @if(session('message'))
        <div id="note">
            {{ session('message') }} <a id="close">&times;</a>
        </div>
    @endif
    
    <div id="contact-name" data-validate="Name is required">
        
        <label> Name </label>
        <input 
            type="text"
            class="@error('name') is-invalid @enderror"
            name="name"
            value="{{ old('name') }}"
            placeholder="Name">
        @error('name')
            <span role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div> <!-- Name end -->

    <div id="contact-email" data-validate="Email is required">
        <label> Email </label>
            <input
                type="email"
                class="@error('email') is-invalid @enderror"
                name="email"
                value="{{old('email')}}"
                placeholder="Email">
            @error('email')
                <span role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
    </div> <!-- Email end -->

    <div id="contact-message" data-validate="Message is required">
        <label> Message </label>
            <textarea 
                class="@error('message')is-danger @enderror"
                name="message"
                rows="2"
                placeholder="Message"
                style="background-color: gainsboro; font-family: sans-serif; color:black;">{{old('message')}}</textarea>
            @error('message')
        <p class="is-danger">
            {{ $errors->first('message') }}
        </p>@enderror
    </div> <!-- Message field --> 

    <div id="contact-submit">
        <button class="btn-submit-contact">Submit</button>
    </div> <!-- Submit button -->

</form>

<script>
    close = document.getElementById("close");

    close.addEventListener('click', function() {
        note = document.getElementById("note");
        note.style.display = 'none';
    }, false);
</script>

@endsection