@extends('layouts.site_app')

@section('content')

<section class="account-page section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mx-auto">
                <div class="row no-gutters">
                <div class="col-md-3">
                    @include('customer/sidebar/index')
                </div>
                <div class="col-md-9">
                    <div class="card card-body account-right">
                        <div class="widget">
                            <div class="section-header">
                                <h5 class="heading-design-h5">
                                    Contact / Delivery Address
                                </h5>
                            </div>
                            <form method="POST" action="{{ route('my-address.store') }}">
                                @csrf
                                @include('customer/partials/message')
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="control-label">Address Line 1 <span class="required">*</span></label>
                                            <textarea 
                                                class="form-control border-form-control" 
                                                name="address_line_1"
                                                placeholder=""
                                            >{{ $user->address_line_1 }}</textarea>
                                            <small>*City/Barangay/Landmark Ex:(Quezon City / Brgy 123 / Across SM)</small>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">House/Unit/Flr #, Bldg Name, Blk or Lot # <span class="required">*</span></label>
                                            <input 
                                                class="form-control border-form-control" 
                                                type="text" 
                                                name="unit_block_street" 
                                                value="{{ $user->unit_block_street }}" 
                                                placeholder=""
                                            />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Zip Code <span class="required">*</span></label>
                                            <input 
                                                class="form-control border-form-control" 
                                                type="text" 
                                                name="zipcode" 
                                                value="{{ $user->zipcode }}" 
                                                placeholder="Enter Zipcode" 
                                            />
                                        </div>
                                    </div>
                                </div>

                                <br />

                                <div class="row">
                                    <div class="col-sm-12 text-right">
                                        <button type="submit" class="btn btn-success btn-lg"> Update Address </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@stop