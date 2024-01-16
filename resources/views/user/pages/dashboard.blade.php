@extends('user/index')

@section('content')
    <div class="main-content">
        <div class="container mt-5">
            <div class="row">
                @foreach ($cars as $car)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{ $car->image }}" class="card-img-top" alt="{{ $car->model }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $car->model }}</h5>
                                <p class="card-text">{{ $car->description }}</p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Year: {{ $car->year }}</li>
                                <li class="list-group-item">Color: {{ $car->color }}</li>
                                <li class="list-group-item">Mileage: {{ $car->mileage }} miles</li>
                            </ul>
                            <div class="card-body">
                                <a href="{{ route('cars.show', $car->id) }}" class="card-link">View Details</a>
                                <a href="#" class="card-link">Contact Seller</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
