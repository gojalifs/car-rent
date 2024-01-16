@extends('owner.index')

@section('content')
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

    <!-- Add New Car Button -->
    <div class="fab-container">
        {{-- <div class="container mt-3"> --}}
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCarModal">
            Add New Car
        </button>
    </div>

    <!-- Add Car Modal -->
    <div class="modal fade" id="addCarModal" tabindex="-1" aria-labelledby="addCarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCarModalLabel">Add New Car</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('owner.add-car') }}">
                        @csrf
                        @if (session('errors'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Something went wrong:
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        @if (Session::has('error'))
                            <div class="alert alert-danger">
                                {{ Session::get('error') }}
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="name">Brand</label>
                            <input id="name" type="text" class="form-control" name="name" tabindex="1" required
                                autofocus>
                            <div class="invalid-feedback">
                                Please fill brand name
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="type">Type</label>
                            <input id="type" type="text" class="form-control" name="type" tabindex="2"
                                required>
                            <div class="invalid-feedback">
                                Please fill car type
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="plat">Plat Number</label>
                            <input id="plat" type="text" class="form-control" name="plat" tabindex="3"
                                required>
                            <div class="invalid-feedback">
                                Please fill in plat number
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fee">Price</label>
                            <input id="fee" type="number" class="form-control" name="fee" tabindex="4">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="7">
                                Add New Car
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
