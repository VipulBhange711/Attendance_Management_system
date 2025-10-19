@include('include.head')
@include('include.sidebar')
@include('include.navbar')

<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card-body p-0 mt-lg-2 mt-0">
                    <h3 class="mb-2">👋 Welcome Back!</h3>
                    <p class="mb-0 mr-4 text-muted">
                        Here’s your personalized dashboard — track performance, manage data, and stay on top of your
                        daily insights.
                    </p>
                </div>

            </div>
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4 card-total-sale">
                                    <div class="icon iq-icon-box-2 bg-info-light">
                                        <img src="{{asset('images/product/1.png')}}" class="img-fluid" alt="image">
                                    </div>
                                    <div>
                                        <p class="mb-2">Total Sales</p>
                                        <h4>31.50</h4>
                                    </div>
                                </div>
                                <div class="iq-progress-bar mt-2">
                                    <span class="bg-info iq-progress progress-1" data-percent="85">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4 card-total-sale">
                                    <div class="icon iq-icon-box-2 bg-danger-light">
                                        <img src="{{asset('images/product/2.png')}}" class="img-fluid" alt="image">
                                    </div>
                                    <div>
                                        <p class="mb-2">Total Cost</p>
                                        <h4>$ 4598</h4>
                                    </div>
                                </div>
                                <div class="iq-progress-bar mt-2">
                                    <span class="bg-danger iq-progress progress-1" data-percent="70">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4 card-total-sale">
                                    <div class="icon iq-icon-box-2 bg-success-light">
                                        <img src="{{asset('images/product/3.png')}}" class="img-fluid" alt="image">
                                    </div>
                                    <div>
                                        <p class="mb-2">Product Sold</p>
                                        <h4>4589 M</h4>
                                    </div>
                                </div>
                                <div class="iq-progress-bar mt-2">
                                    <span class="bg-success iq-progress progress-1" data-percent="75">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- Page end  -->
    </div>
</div>
</div>

@include('include.footer')