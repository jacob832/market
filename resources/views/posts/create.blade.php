@extends('layouts.app')

@section('content')


<div class="container">
    
    <form action="/p" enctype="multipart/form-data" method="post">
        @csrf 

         <div class="col-md-6">
            Prodauct Name
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
        </div>
     <div class="row">
         Image
         <input type="file" name="image">
     </div>

     <div class="row">
         Exxpire Date
         <input type="date" name="expireDate">
     </div>

     <div class="row">
         minNoDaysFirstOffer
         <input type="number" name="minNoDaysFirstOffer">
     </div>

     <div class="row">
         minNoDaysSecondOffer
         <input type="number" name="minNoDaysSecondOffer">
     </div>

     <div class="row">
         minNoDaysThirdOffer
         <input type="number" name="minNoDaysThirdOffer">
     </div>

     <div class="row">
         firstOfferPrice
         <input type="number" step="0.01" name="firstOfferPrice">
     </div>

     <div class="row">
         secondOfferPrice
         <input type="number" step="0.01" name="secondOfferPrice">
     </div>

     <div class="row">
         thirdOfferPrice
         <input type="number" step="0.01" name="thirdOfferPrice">
     </div>

     <div class="row">
         Category
         <input type="text" name="category">
     </div>

     <div class="row">
         PhoneNumber
         <input type="text" name="phoneNumber">
     </div>



     <div class="row">
         Quantity
         <input type="number" name="quantity">
     </div>


     <div class="row">
         Price
         <input type="number" step="0.01" name="price">
     </div>


    <div class="row">
         <button class="btn">
            Add new Product  
        </button>
    </div>
        </form>
         @if($errors->any())
        <div class="row collapse">
            <ul class="alert-box warning radius">
                @foreach($errors->all() as $error)
                    <li> {{ $error }} </li>
                @endforeach
            </ul>
        </div>
        @endif
 </div>

@endsection
 