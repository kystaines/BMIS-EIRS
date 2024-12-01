<?php
include_once('session.php');
$page = 'User Profiles';
?>

<?php include_once('../includes/head.php') ?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php include_once('../includes/preloader.php') ?>
        <?php include_once('../includes/navbar.php') ?>
        <?php include_once('../includes/aside.php') ?>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h1 class="card-title">User Profiles</h1>
                            <button class="btn btn-primary btn-sm card-title float-right create" data-toggle="modal" data-target="#modal">
                                <i class="fa fa-plus"></i> ADD RECORD
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h4 class="card-title">Records</h4>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="dataTable" class="table table-hover table-head-fixed text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>FULL NAME</th>
                                                <th>NATIONAL ID</th>
                                                <th>AGE</th>
                                                <th>GENDER</th>
                                                <th>CIVIL STATUS</th>
                                                <th>VOTER STATUS</th>
                                                <th class="text-center">ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1.</td>
                                                <td>Dela Cruz, John Doe</td>
                                                <td>1234</td>
                                                <td>23</td>
                                                <td>Male</td>
                                                <td>Single</td>
                                                <td>Acive</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>&nbsp;Edit</button>
                                                    <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;Delete</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2.</td>
                                                <td>Dela Cruz, John Doe</td>
                                                <td>1234</td>
                                                <td>23</td>
                                                <td>Male</td>
                                                <td>Single</td>
                                                <td>In-Active</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>&nbsp;Edit</button>
                                                    <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;Delete</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </section>
        </div>
        <?php include_once('../includes/footer.php') ?>
    </div>
    <?php include_once('./modal/user_profiles.php') ?>
    <?php include_once('../includes/script.php') ?>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "responsive": false,
                "autoWidth": false,
                'ordering': false,
                "scrollX": true,
                // "ajax": {
                //     type: 'post',
                //     url: 'ajax',
                //     data: {
                //         table: ''
                //     },
                // }
            });
        })
    </script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('.img-content').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                $('.img-content').attr('src', '../images/upload_image.png');
            }
        }

        $(document).on('click', '.create', function() {
            $('#modal #action').val('create_user_profile')
        })

        const stepper = new Stepper(document.querySelector('#stepper'));

        function nextStep(currentStep) {
            const form = document.getElementById(`form${currentStep}`);
            if (form.checkValidity()) {
                stepper.next();
            } else {
                form.reportValidity();
            }
        }

        function prevStep(currentStep) {
            stepper.previous();
        }

        function submitForm(event) {
            event.preventDefault();
            const form1 = document.getElementById('form1');
            const form2 = document.getElementById('form2');
            const form3 = document.getElementById('form3');
            const form4 = document.getElementById('form4');
            if (form3.checkValidity()) {
                // Here you can handle the form submission, e.g., send data to the server
                var data = new FormData()
                var form_data = $(form1).serializeArray()
                $.each(form_data, function(key, input) {
                    data.append(input.name, input.value)
                })
                var form_data = $(form2).serializeArray()
                $.each(form_data, function(key, input) {
                    data.append(input.name, input.value)
                })
                var form_data = $(form3).serializeArray()
                $.each(form_data, function(key, input) {
                    data.append(input.name, input.value)
                })
                var form_data = $(form4).serializeArray()
                $.each(form_data, function(key, input) {
                    data.append(input.name, input.value)
                })
                data.append('file', $('#modal #file')[0].files[0])

                // Send the form data to the server using AJAX
                $.ajax({
                    type: 'POST',
                    url: 'ajax.php', // Replace with your server-side script
                    data: data,
                    dataType: "json",
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        loading()
                    },
                    success: function(response) {
                        if (response.status == 'ok') {
                            $('#modal').modal('hide')
                            $('#modal form').trigger('reset')
                            Swal.fire({
                                title: response.title,
                                text: response.text,
                                html: response.html,
                                icon: response.icon,
                                allowOutsideClick: false,
                            })
                        } else {
                            Swal.fire({
                                title: response.title,
                                text: response.text,
                                html: response.html,
                                icon: response.icon,
                                allowOutsideClick: false,
                            })
                        }
                    },
                    error: function(xhr, status, error) {
                        error()
                    }
                });
            } else {
                form.reportValidity();
            }
        }
    </script>