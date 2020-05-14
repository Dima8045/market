@extends('layouts.app', ['title' => __('New Coupon')])

@section('content')
    @include('coupons.partials.header', ['title' => __('Edit Coupon')])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Edit Coupon') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('coupons.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('coupons.update', $coupon) }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">{{ __('Coupon information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-coupon-code">{{ __('Code') }}</label>
                                    <div class="row">
                                        <div class="col">
                                            <div class="input-group input-group-alternative">
                                                <input type="text" name="code" id="input-coupon-code" class="form-control" placeholder="{{ __('Code') }}" value="{{ $coupon->code }}" required autofocus>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="input-group input-group-alternative">
                                                <button type="button" id="generate-coupon-code" class="btn btn-primary">{{ __('Generate Code') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($errors->has('code'))
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $errors->first('code') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group-start-end-date">
                                    <div class="input-daterange datepicker row align-items-center">
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-start_date">{{ __('End Date') }}</label>
                                                <div class="input-group input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                                    </div>
                                                    <input class="form-control" name="start_date" placeholder="Start date" type="text" value="{{ \Carbon\Carbon::create($coupon->start_date)->format('d.m.Y')}}" autofocus>
                                                </div>
                                                @if ($errors->has('start_data'))
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $errors->first('start_data') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-end_date">{{ __('End Date') }}</label>
                                                <div class="input-group input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                                    </div>
                                                    <input class="form-control" name="end_date" placeholder="End date" type="text" value="{{ \Carbon\Carbon::create($coupon->end_date)->format('d.m.Y')}} " autofocus>
                                                </div>
                                                @if ($errors->has('end_data'))
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $errors->first('end_data') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group-coupon-type">
                                    <div class="input-coupon-type row">
                                        <div class="col">
                                            <div class="">
                                                <label class="form-control-label" for="input-type">{{ __('Coupon type') }}</label>
                                                <div class="input-group input-group-alternative">
                                                    <select class="form-control" name="type" placeholder="{{ __('Coupon type') }}" autofocus>
                                                        @foreach($couponType as $key => $value)
                                                            <option value="{{ $value }}" @if($coupon->type) == ucfirst($value)) selected @endif>{{ ucfirst($value) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-amount">{{ __('Amount') }}</label>
                                                <div class="input-group input-group-alternative">
                                                    <input class="form-control" name="amount" placeholder="{{ __('Amount') }}" type="number" max="100" step="0.01" value="{{ $coupon->amount }}" autofocus>
                                                </div>
                                                @if ($errors->has('amount'))
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $errors->first('amount') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('active') ? ' is-invalid' : '' }}">
                                    <div class="row justify-content-between">
                                        <div class="col-auto">
                                            <label class="form-control-label">{{ __('Active') }}</label>
                                        </div>
                                        <div class="col-auto">
                                            <label class="custom-toggle">
                                                <input type="checkbox" name="active" @if($coupon->active) checked @endif autofocus>
                                                <span class="custom-toggle-slider rounded-circle"></span>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('active'))
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $errors->first('active') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <div class="row justify-content-between">
                                        <div class="col-auto">
                                            <label class="form-control-label">{{ __('Used') }}</label>
                                        </div>
                                        <div class="col-auto">
                                            <label class="custom-toggle">
                                                <input type="checkbox" name="is_used" @if($coupon->is_used) checked @endif autofocus>
                                                <span class="custom-toggle-slider rounded-circle"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
<script src="{{ asset('argon') }}/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

    <script>
      let today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
      console.log(today)
      $('.datepicker').datepicker({
        format: 'dd.mm.yyyy',
        startDate: '+1d',
        minDate: today,
        weekStart: 1,
      });

      let generateCouponCodeUrl = '{{ route('coupons.generateCode') }}'
    </script>

<script src="{{ asset('/js/coupon/coupon.js') }}"></script>
@endpush