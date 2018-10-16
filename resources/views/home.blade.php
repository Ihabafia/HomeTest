@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">My Portfolio</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @csrf
                    @if (!$purchases->isEmpty())
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Comapny Name</th>
                                    <th>S. I. Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total Investment</th>
                                    <th>Certificate Number</th>
                                    <th>Transaction Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <th colspan="8">{{ $purchases->links() }}</th>
                            </tfoot>
                            <tbody>
                                @foreach($purchases as $purchase)
                                    @include('purchases.purchase')
                                @endforeach
                            </tbody>
                        </table>
                        <h3>
                            Total Investment: ${{ $total }}
                            <a href="/purchase/create" class="btn btn-lg btn-outline-primary pull-right">Add Instrument</a>
                        </h3>
                    @else
                        <div class="text-center">
                            <h3 class="text-center">You have no shared purchased yet...</h3>
                            <a href="/purchase/create" class="btn btn-lg btn-outline-primary">Add Instrument</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
