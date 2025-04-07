@extends('layouts.welcome_admin')

@section('content')
<div class="container">
    <h2 class="mb-4">Order Menu - Admin Panel</h2>

    <!-- Form to Add Food Item -->
    <div class="card mb-4">
        <div class="card-header">Add Food Item</div>
        <div class="card-body">
            <form action="{{ route('admin.food.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Food Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <input type="text" class="form-control" id="category" name="category" required>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Food</button>
            </form>
        </div>
    </div>

    <!-- Display Existing Food Items -->
    <div class="card">
        <div class="card-header">Food List</div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($foods as $food)
                        <tr>
                            <td>{{ $food->id }}</td>
                            <td>{{ $food->name }}</td>
                            <td>{{ $food->category }}</td>
                            <td>${{ number_format($food->price, 2) }}</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-warning">Edit</a>
                                <a href="#" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
