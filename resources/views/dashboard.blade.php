@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-1">
                <div class="card-body">
                    <h3 class="card-title text-white">Products Sold</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">4565</h2>
                        <p class="text-white mb-0">Jan - March 2019</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-cart"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-2">
                <div class="card-body">
                    <h3 class="card-title text-white">Net Profit</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">$ 8541</h2>
                        <p class="text-white mb-0">Jan - March 2019</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-3">
                <div class="card-body">
                    <h3 class="card-title text-white">New Customers</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">4565</h2>
                        <p class="text-white mb-0">Jan - March 2019</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-4">
                <div class="card-body">
                    <h3 class="card-title text-white">Customer Satisfaction</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">99%</h2>
                        <p class="text-white mb-0">Jan - March 2019</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-heart"></i></span>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-0">Store Location</h4>
                    <div id="world-map" style="height: 500px;"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-12">

            <div class="card">
                <div class="chart-wrapper mb-4">
                    <div class="px-4 pt-4 d-flex justify-content-between">
                        <div>
                            <h4>Sales Activities</h4>
                            <p>Last 6 Month</p>
                        </div>
                        <div>
                            <span><i class="fa fa-caret-up text-success"></i></span>
                            <h4 class="d-inline-block text-success">720</h4>
                            <p class=" text-danger">+120.5(5.0%)</p>
                        </div>
                    </div>
                    <div>
                        <div id="smil-animations" class="ct-chart ct-golden-section"></div>
                    </div>
                </div>
                <div class="card-body border-top pt-4">
                    <div class="row">
                        <div class="col-sm-6">
                            <ul>
                                <li>5% Negative Feedback</li>
                                <li>95% Positive Feedback</li>
                            </ul>
                            <div>
                                <h5>Customer Feedback</h5>
                                <h3>385749</h3>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div id="chart_widget_3_1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Bordered Table</h4>
                    <div class="table-responsive">
                        <table id="myTable" class="table table-bordered verticle-middle">
                            <thead>
                                <tr>
                                    <th scope="col">Task</th>
                                    <th scope="col">Progress</th>
                                    <th scope="col">Deadline</th>
                                    <th scope="col">Label</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Air Conditioner</td>
                                    <td>
                                        <div class="progress" style="height: 10px">
                                            <div class="progress-bar gradient-1" style="width: 70%;" role="progressbar">
                                                <span class="sr-only">70% Complete</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Apr 20,2018</td>
                                    <td><span class="label gradient-1 btn-rounded">70%</span>
                                    </td>
                                    <td><span><a href="#" data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                    class="fa fa-pencil color-muted m-r-5"></i> </a><a href="#"
                                                data-toggle="tooltip" data-placement="top" title="Close"><i
                                                    class="fa fa-close color-danger"></i></a></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Textiles</td>
                                    <td>
                                        <div class="progress" style="height: 10px">
                                            <div class="progress-bar gradient-2" style="width: 70%;" role="progressbar">
                                                <span class="sr-only">70% Complete</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>May 27,2018</td>
                                    <td><span class="label gradient-2 btn-rounded">70%</span>
                                    </td>
                                    <td><span><a href="#" data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                    class="fa fa-pencil color-muted m-r-5"></i> </a><a href="#"
                                                data-toggle="tooltip" data-placement="top" title="Close"><i
                                                    class="fa fa-close color-danger"></i></a></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Milk Powder</td>
                                    <td>
                                        <div class="progress" style="height: 10px">
                                            <div class="progress-bar gradient-3" style="width: 70%;" role="progressbar">
                                                <span class="sr-only">70% Complete</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>May 18,2018</td>
                                    <td><span class="label gradient-3 btn-rounded">70%</span>
                                    </td>
                                    <td><span><a href="#" data-toggle="tooltip" data-placement="top"
                                                title="Edit"><i class="fa fa-pencil color-muted m-r-5"></i> </a><a
                                                href="#" data-toggle="tooltip" data-placement="top"
                                                title="Close"><i class="fa fa-close color-danger"></i></a></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Vehicles</td>
                                    <td>
                                        <div class="progress" style="height: 10px">
                                            <div class="progress-bar gradient-4" style="width: 70%;" role="progressbar">
                                                <span class="sr-only">70% Complete</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Mar 27,2018</td>
                                    <td><span class="label gradient-4 btn-rounded">70%</span>
                                    </td>
                                    <td><span><a href="#" data-toggle="tooltip" data-placement="top"
                                                title="Edit"><i class="fa fa-pencil color-muted m-r-5"></i> </a><a
                                                href="#" data-toggle="tooltip" data-placement="top"
                                                title="Close"><i class="fa fa-close color-danger"></i></a></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Boats</td>
                                    <td>
                                        <div class="progress" style="height: 10px">
                                            <div class="progress-bar gradient-9" style="width: 70%;" role="progressbar">
                                                <span class="sr-only">70% Complete</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Jun 28,2018</td>
                                    <td><span class="label gradient-9 btn-rounded">70%</span>
                                    </td>
                                    <td><span><a href="#" data-toggle="tooltip" data-placement="top"
                                                title="Edit"><i class="fa fa-pencil color-muted m-r-5"></i> </a><a
                                                href="#" data-toggle="tooltip" data-placement="top"
                                                title="Close"><i class="fa fa-close color-danger"></i></a></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Boats</td>
                                    <td>
                                        <div class="progress" style="height: 10px">
                                            <div class="progress-bar gradient-2" style="width: 70%;" role="progressbar">
                                                <span class="sr-only">70% Complete</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Aug 20,2018</td>
                                    <td><span class="label gradient-2 btn-rounded">70%</span>
                                    </td>
                                    <td><span><a href="#" data-toggle="tooltip" data-placement="top"
                                                title="Edit"><i class="fa fa-pencil color-muted m-r-5"></i> </a><a
                                                href="#" data-toggle="tooltip" data-placement="top"
                                                title="Close"><i class="fa fa-close color-danger"></i></a></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination justify-content-center">
                                <li class="page-item">
                                    <a class="page-link" href="#" id="prevBtn">«</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#" id="nextBtn">»</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
