@extends('layouts.app', ['title' => __('Coupons list')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Coupons') }} </h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('coupons.create') }}" class="btn btn-sm btn-primary">{{ __('Add coupon') }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Code') }}</th>
                                    <th scope="col">{{ __('Start Date') }}</th>
                                    <th scope="col">{{ __('End Date') }}</th>
                                    <th scope="col">{{ __('Type') }}</th>
                                    <th scope="col">{{ __('Amount') }}</th>
                                    <th scope="col">{{ __('active') }}</th>
                                    <th scope="col">{{ __('Is Used') }}</th>
                                    <th scope="col" class="text-center">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($coupons))
                                    @foreach ($coupons as $coupon)
                                        <tr>
                                            <td>{{ $coupon->code }}</td>
                                            <td>{{ $coupon->start_date }}</td>
                                            <td>{{ $coupon->end_date }}</td>
                                            <td>
                                                @if($coupon->type == \App\Coupon::COUPON_TYPE[0])
                                                    <span class="badge badge-pill badge-info">%</span>
                                                @endif
                                                @if($coupon->type == \App\Coupon::COUPON_TYPE[1])
                                                    <span class="badge badge-pill badge-default">$</span>
                                                @endif
                                            </td>
                                            <td>{{ $coupon->amount }}</td>
                                            <td><span class="badge badge-pill {{ $coupon->active ? 'badge-success' : 'badge-secondary'}}">{{ $coupon->active ? 'Active' : 'Inactive'}}</span></td>
                                            <td><span class="badge badge-pill {{ $coupon->is_used ? 'badge-secondary' : 'badge-primary'}}">{{ $coupon->is_used ? 'Used' : 'Unused'}}</span></td>
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        @hasanyrole('super-admin|admin|editor')
                                                        <form action="{{ route('coupons.destroy', $coupon) }}" method="post">
                                                                @csrf
                                                                @method('delete')

                                                                <a class="dropdown-item" href="{{ route('coupons.edit', $coupon) }}">{{ __('Edit') }}</a>
                                                                <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this coupon?") }}') ? this.parentElement.submit() : ''">
                                                                    {{ __('Delete') }}
                                                                </button>
                                                            </form>
                                                        @endhasanyrole
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $coupons->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
