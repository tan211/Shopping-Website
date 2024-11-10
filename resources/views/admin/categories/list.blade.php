@extends('admin.layouts.master')
@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
        {{session('success')}}
    </div>
@endif
@if($errors->any())
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Basic Table</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Basic Table</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Default Table</h4>
                    <h6 class="card-subtitle">Using the most basic table markup, here’s how <code>.table</code>-based tables look in Bootstrap. All table styles are inherited in Bootstrap 4, meaning any nested tables will be styled in the same manner as the parent.</h6>
                    <h6 class="card-title m-t-40"><i class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i> Table With Outside Padding</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                foreach ($data as $key => $value) {
                                    echo '
                                    <tr role="row">
                                        <th scope="row">'.$value['id'].'</th>
                                        <td>'.$value['name'].'</td>
                                        <td>
                                            <a href="'.url('admin/category/edit/'.$value['id']).'">
                                                <i class="m-r-10 mdi mdi-account-edit"></i>
                                                <span>Edit</span>
                                            </a>
                                            <a href="'.url('admin/category/delete/'.$value['id']).'">
                                                <i class="m-r-10 mdi mdi-delete"></i>
                                                <span>Delete</span>
                                            </a>
                                        </td>
                                    </tr>';
                                }
                            ?>
                                <!-- <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>
                                        <a href="#"><i class="m-r-10 mdi mdi-account-edit"></i><span>Edit</span></a>
                                        <a href="#"><i class="m-r-10 mdi mdi-delete"></i><span>Delete</span></a>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Jacob</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Larry</td>
                                </tr> -->
                            </tbody>
                        </table>
                        <div class="col-sm-12">
                            <a href="{{ url('admin/category/add') }}" class="btn btn-success">Add category</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection