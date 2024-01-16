@extends('owner.index')

@section('content')
    <div class="container mt-5">
        <div id="flash-data" data-flashdata="{{ Session::get('success') }}"></div>
        @if (Session::get('error'))
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-12">
                    <div class="alert alert-danger alert-has-icon alert-dismissible show fade">
                        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>×</span>
                            </button>
                            {{ Session::get('error') }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            @foreach ($cars as $car)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ $car->image }}" class="card-img-top" alt="{{ $car->model }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $car->merk }} {{ $car->type }}</h5>
                            <p class="card-text">Rp.{{ $car->fee }}</p>
                            <p class="card-text">{{ $car->plat }}</p>
                        </div>
                        <div class="card-body">
                            <button data-bs-toggle="modal" data-bs-target="#editCarModal_{{ $car->id }}"
                                class="btn btn-outline-primary">Edit</button>
                            <button data-bs-toggle="modal" data-bs-target="#deleteCarModal_{{ $car->id }}"
                                class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                </div>

                {{-- Edit Modal --}}
                <div class="modal fade" id="editCarModal_{{ $car->id }}" tabindex="-1"
                    aria-labelledby="addCarModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addCarModalLabel">Add New Car</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('owner.update-car') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input id="id" type="hidden" class="form-control" name="id"
                                            value="{{ $car->id }}" required autofocus>
                                    </div>
                                    <div class="form-group">
                                        <label for="merk">Brand</label>
                                        <input id="merk" type="text" class="form-control" name="merk"
                                            value="{{ $car->merk }}" tabindex="1" required autofocus>
                                        <div class="invalid-feedback">
                                            Please fill brand name
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="type">Type</label>
                                        <input id="type" type="text" class="form-control" name="type"
                                            value="{{ $car->type }}" tabindex="2" required>
                                        <div class="invalid-feedback">
                                            Please fill car type
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="plat">Plat Number</label>
                                        <input id="plat" type="text" class="form-control" name="plat"
                                            value="{{ $car->plat }}" tabindex="3" required>
                                        <div class="invalid-feedback">
                                            Please fill in plat number
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fee">Price</label>
                                        <input id="fee" type="number" class="form-control" name="fee"
                                            value="{{ $car->fee }}" tabindex="4">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="7">
                                            Edit Data
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Delete Modal --}}
                <div class="modal fade" id="deleteCarModal_{{ $car->id }}" tabindex="-1"
                    aria-labelledby="addCarModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addCarModalLabel">Are you sure you want to delete
                                    {{ $car->merk }} {{ $car->type }}?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('owner.delete-car') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input id="id" type="hidden" class="form-control" name="id"
                                            value="{{ $car->id }}" required>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-danger btn-lg btn-block" tabindex="1">
                                            Yes, delete
                                        </button>
                                    </div>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary btn-lg btn-block" tabindex="2"
                                            data-bs-dismiss="modal">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
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
                        <div class="form-group">
                            <label for="merk">Brand</label>
                            <input id="merk" type="text" class="form-control" name="merk" tabindex="1"
                                required autofocus>
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
