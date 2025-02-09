@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Manage Bids</h2>
    
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Car</th>
                    <th>Bidder</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bids as $bid)
                <tr>
                    <td>{{ $bid->id }}</td>
                    <td>{{ $bid->car->name }}</td>
                    <td>{{ $bid->user->name }}</td>
                    <td>${{ number_format($bid->amount, 2) }}</td>
                    <td>
                        <span class="badge bg-{{ $bid->status === 'pending' ? 'warning' : ($bid->status === 'accepted' ? 'success' : 'danger') }}">
                            {{ ucfirst($bid->status) }}
                        </span>
                    </td>
                    <td>{{ $bid->created_at->format('M d, Y H:i') }}</td>
                    <td>
                        @if($bid->status === 'pending')
                        <form action="{{ route('bids.update', $bid) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" name="status" value="accepted" class="btn btn-success btn-sm">Accept</button>
                            <button type="submit" name="status" value="rejected" class="btn btn-danger btn-sm">Reject</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
