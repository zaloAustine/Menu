<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>QIXER - Service Based Business HTML Template</title>

    <!-- favicon -->
    <link rel=icon href="favicons.ico" sizes="16x16" type="icon/ico">
    <!-- animate -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css">
    <!-- bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- slick carousel  -->
    <link rel="stylesheet" href="assets/css/slick.css">
    <!-- LineAwesome -->
    <link rel="stylesheet" href="assets/css/line-awesome.min.css">
    <!-- Nice Select -->
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="assets/css/style.css">

    <head>
        <script src='https://cdn.firebase.com/js/client/2.2.1/firebase.js'></script>
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
    </head>
</head>
<body>
<div class="body-overlay"></div>
<div class="dashboard-area dashboard-padding">
    <div class="container-fluid">
        <div class="dashboard-contents-wrapper">
            <div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="dashboard-settings dashboard-flex-shwing">
                            <h2 class="dashboards-title">Incoming Orders</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 margin-top-40">
                        <div class="dashboard-status-list">
                            <ul class="tabs status-order-list margin-bottom-10">
                                <li class="active" data-tab="tab-active"> Active Orders<span id="span"
                                                                                             class="numbers"></span>
                                </li>
                            </ul>
                        </div>
                        <div id="tab-active" class="tab-content-item active">
                            <div class="table-responsive table-responsive--md table-responsive-lg">
                                <table id="user_data" class="display" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Location</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody id="table-body-pengguna">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="add-tab" class="tab-content-item">
                            <div class="signup-area padding-top-100 padding-bottom-100">
                                <div class="container">
                                    <div class="signup-wrapper">
                                        <div class="signup-contents">
                                            <h3 class="signup-title"> Add New Food<span><h5
                                                        class="primaryColor"></h5></span></h3>
                                            <form class="signup-forms" method="POST">
                                                @csrf
                                                <div class="single-signup margin-top-30">
                                                    <label class="signup-label">Name </label>
                                                    <input class="form--control @error('name') is-invalid @enderror"
                                                           type="text" id="name" name="name" placeholder="Enter Name">
                                                    @error('name')
                                                    @enderror
                                                </div>
                                                <div class="single-signup margin-top-30">
                                                    <label class="signup-label">Description </label>
                                                    <input class="form--control @error('name') is-invalid @enderror"
                                                           type="text" id="name" name="name"
                                                           placeholder="Enter food description">
                                                    @error('name')
                                                    @enderror
                                                </div>
                                                <label class="signup-label">Food Image</label>
                                                <input type="file" id="img" name="img" accept="image/*">
                                                <button type="submit">Next</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Dashboard area end -->
<!-- back to top area start -->
<div class="back-to-top">
    <span class="back-top"><i class="las la-angle-up"></i></span>
</div>
<!-- back to top area end -->


<!-- jquery -->
<script src="assets/js/jquery-3.6.0.min.js"></script>
<!-- jquery Migrate -->
<script src="assets/js/jquery-migrate.min.js"></script>
<!-- bootstrap -->
<script src="assets/js/bootstrap.bundle.min.js"></script>
<!-- wow -->
<script src="assets/js/wow.min.js"></script>
<!-- Slick Slider -->
<script src="assets/js/slick.js"></script>
<!-- Nice Select -->
<script src="assets/js/jquery.nice-select.js"></script>
<!-- Nice Scroll -->
<script src="assets/js/jquery.nicescroll.min.js"></script>
<!-- main js -->
<script src="//cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>

{{--<script src="{{asset('/js/AppLogic.js')}}"></script>--}}


<script src="https://www.gstatic.com/firebasejs/7.3.0/firebase.js"></script>

<script>
    // Your web app's Firebase configuration
    const firebaseConfig = {
        apiKey: "AIzaSyB3sWFcQ7QDMRvPPjqnUj9AsFTLTXN1n_o",
        authDomain: "riarafoodapp.firebaseapp.com",
        // The value of `databaseURL` depends on the location of the database
        databaseURL: "https://riarafoodapp-default-rtdb.firebaseio.com/",
        projectId: "riarafoodapp",
        storageBucket: "riarafoodapp.appspot.com",
        messagingSenderId: "SENDER_ID",
        appId: "1:1009996849406:android:f2e76789faf72de6c8c5af",
        // For Firebase JavaScript SDK v7.20.0 and later, `measurementId` is an optional field
        measurementId: "G-MEASUREMENT_ID",
    };

    firebase.initializeApp(firebaseConfig);
    var ref = firebase.database().ref().child('Orders');


    $('#user_data').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'csv'
        ]
    });

    ref.once('value', (snapshot) => {

        snapshot.forEach((childSnapshot) => {
            var list = childSnapshot.val()
            var key = Object.keys(list)

            $("#span").append(key.length)

            childSnapshot.forEach((snap) => {
                var data = snap.val();

                $("#table-body-pengguna").append("<tr><td>" + data['name'] + "</td><td>" + data['location'] +
                    "</td><td>" + data['total'] + "</td><td>" + "" + "</td></tr>");


            });
        });
    });


</script>

</body>

</html>
