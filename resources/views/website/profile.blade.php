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
                              My Profile
                           </h5>
                        </div>
                        <form method="POST" action="{{ route('customer-profile.store') }}">
                           <input type="hidden" name="user_id" value="{{ $user->id }}" />
                           @csrf

                           @include('customer/partials/message')

                           <div class="row">
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <label class="control-label">First Name <span class="required">*</span></label>
                                    <input class="form-control border-form-control" type="text" name="firstname" value="{{ $user->firstname }}" placeholder="Enter Firstname">
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <label class="control-label">Last Name <span class="required">*</span></label>
                                    <input class="form-control border-form-control" type="text" name="lastname" value="{{ $user->lastname }}" placeholder="Enter Lastname">
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <label class="control-label">Contact No <span class="required">*</span></label>
                                    <input class="form-control border-form-control" type="text" name="contact_no" value="{{ $user->contact_no }}" placeholder="Enter Contact No.">
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <label class="control-label">Email Address <span class="required">*</span></label>
                                    <input class="form-control border-form-control" type="email" name="email" value="{{ $user->email }}" placeholder="Enter Email Address" disabled>
                                 </div>
                              </div>
                           </div>

                           <hr />

                           <div class="section-header mb-2">
                              <h5 class="heading-design-h5 mb-0">
                                 Change Password
                              </h5>
                              <small>Leave blank for no password change</small>
                           </div>
                           
                           <div class="row">
                              <div class="col-sm-12">
                                 <div class="form-group">
                                    <label class="control-label">Old Password</label>
                                    <input class="form-control border-form-control" type="password" name="old_password" placeholder="Enter Old Password">
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <label class="control-label">New Password</label>
                                    <input class="form-control border-form-control" type="password" name="new_password" placeholder="Enter New Password">
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <label class="control-label">Confirm New Password</label>
                                    <input class="form-control border-form-control" type="password" name="confirm_password" placeholder="Confirm New Password">
                                 </div>
                              </div>
                           </div>

                           <br />

                           <div class="row">
                              <div class="col-sm-12 text-right">
                                 <button type="submit" class="btn btn-success btn-lg"> Save Changes </button>
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