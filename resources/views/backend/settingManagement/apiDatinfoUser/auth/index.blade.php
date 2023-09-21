@extends('backend.layouts.master')
@section('title', 'DAT Management')
@section('content')
   
    <!--start page wrapper -->

    <div class="page-wrapper">

        <div class="page-content">

           



            <ul class="nav nav-tabs">

                <li class="pending_approval active"><a href="{{ url('/admin/setting/dat/user/api') }}" data-toggle="tab"
                        aria-expanded="true">All Dat Users</a>

                </li>

                <!--<li class="pending_approval"><a href="{{ url('/admin/trashed-user') }}" data-toggle="tab"-->
                <!--        aria-expanded="true">Trashed Users</a>-->

                <!--</li>-->

                <!--<li class="all_leave"><a href="{{ url('/admin/users/create') }}" data-toggle="tab" aria-expanded="false">Add-->
                <!--        New</a>-->

                <!--</li>-->

            </ul>



            <!--end breadcrumb-->

            @if ($message = Session::get('success'))
                <div class="alert alert-success">

                    <p>{{ $message }}</p>

                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="row">
            			<div class="col-md-12">
            				<div class="row">
            					<div class="col-md-4">
            						<div class="load-box">
            							<span class="headlight">On Route</span>
            							<h4>Owner Details</h4>
            							<div class="load-btn">
            								<a href="#" class="btn btn-danger btn-sm">Action</a>
            								<a href="#" class="btn btn-primary btn-sm">Logs</a>
            							</div>
            							<p><b>Partner Name: </b>Karabjot Kour</p>
            							<p><b>Company Name: </b>Karabjot Kour</p>
            							<p><b>Broker Name: </b>Haninder Singh</p>
            							<p><b>Email: </b>hanindersingh@gmail.com</p>
            							<p><b>Toll Free No: </b>(916) 306-0225</p>
            						</div>
            					</div>
            					
            					<div class="col-md-4">
            						<div class="load-box shipper">
            							<span class="headlight">SH393</span>
            							<h4>Shipper Information</h4>
            							<div class="load-btn">
            								<a href="#" class="btn btn-danger btn-sm">Action</a>
            								<a href="#" class="btn btn-primary btn-sm">Logs</a>
            							</div>
            							<p><b>Partner Name: </b>Karabjot Kour</p>
            							<p><b>Company Name: </b>Karabjot Kour</p>
            							<p><b>Broker Name: </b>Haninder Singh</p>
            							<p><b>Email: </b>hanindersingh@gmail.com</p>
            							<p><b>Toll Free No: </b>(916) 306-0225</p>
            						</div>
            					</div>
            				</div>
            			</div>
            		</div>
                </div>
            </div>

        </div>



    </div>

    <!--end page wrapper -->

    @include('backend.common.footer')





    {{-- <script>

    $('#carrier_table').DataTable({

        'ajax':{

            'url': "{{ url('admin/changeuserStatus/') }}",

            "error": function(reason) {

                console.log(reason);

            }

        },

        

    });









	'ajax':{

            'url': "{{ url('admin/data/categories') }}",

            "error": function(reason) {

                console.log(reason);

            },

            "complete": function (data) {

                $('.stat_check').bootstrapToggle({

                    on: 'Active',

                    off: 'Inactive'

                });

            }

        },



</script> --}}







    {{-- <script>

	$(document).on('click','#check1', function(){

		

		if($(this).is(':checked')){

			var statid = $(this).data-attr(cat);

			alert(statid);

		}

        else{

            alert('unchecked');

		}

		

		//ShowLoaderTimeLine();

			$.ajax({

				url: HOSTPATH+'admin/changeuserStatus',

				type: 'get',

				cache : false,

				data: {agency_id:agency_id},

				success: function(data){

					$('#agency_detail_edit').html(data);

					setTimeout(function () {

							Swal.close();

							$('#agency_detail_edit').modal('show');

					}, 500);

				}

			});

	});

</script> --}}



    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script language="javascript">
        $("#checkAll").click(function() {
            $('.check_id input:checkbox').not(this).prop('checked', this.checked);
        });

        $(".check_id input, #checkAll").click(function() {
            if ($(".check_id input").prop('checked') == true) {
                $(".delete_user").fadeIn();
            } else {
                $(".delete_user").fadeOut();
            }

        })

        $("#deleteuser").submit(function() {
            return confirm("Are You Sure Delete All Data ?");
        })
    </script>


    <script>
        $(function() {
            $(document).on('change', '.stat_check', function() {
                var curr = $(this).prop('checked');
                var cat = $(this).attr('cat');
                $.ajax({
                    type: "post",
                    url: "{{ url('admin/changeuserStatus') }}",
                    data: {
                        'curr': curr,
                        'cat': cat
                    },
                    success: function(resp) {
                        if (resp.status == 'true') {
                            swal(resp.msg, '', 'success');
                        } else {
                            swal(resp.msg, '', 'warning');
                        }
                    }
                })
            })
        })
    </script>







    <script>
        $(document).ready(function() {

            $('#carrier_table').DataTable({
                dom: 'Blfrtip',
                buttons: [{
                        extend: 'csv',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    'colvis'
                ],

                columnDefs: [{
                    // targets: -2,
                    visible: false
                }]
            });

            //user filter req
            $("a.b_status").click(function(e) {
                e.preventDefault();
                var filter_type = $(this).attr('search-type');
                var filter_value = $(this).attr('value');
                $("a.b_status").removeClass("active");
                $(this).addClass("active");
                $.ajax({
                    url: "{{ url('/admin/user-filter') }}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        filter_type: filter_type,
                        filter_value: filter_value,
                    },
                    success: function(response) {
                        let timerInterval
                        Swal.fire({
                            title: 'Wait..',
                            html: 'I will Filter in <b></b> milliseconds.',
                            timer: 1000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading()
                                const b = Swal.getHtmlContainer().querySelector('b')
                                timerInterval = setInterval(() => {
                                    b.textContent = Swal.getTimerLeft()
                                }, 500)
                            },
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        }).then((result) => {
                            /* Read more about handling dismissals below */
                            if (result.dismiss === Swal.DismissReason.timer) {
                                console.log('I was closed by the timer')
                            }
                        })
                        setTimeout(function() {
                            $("#user_data").html(response);
                            $("div#carrier_table_paginate, div#carrier_table_info")
                                .hide();
                        }, 500)
                    }
                });
            })

        });
    </script>





    <!--<script>
        -- >

        <
        !--$(document).ready(function() {
            -- >

            <
            !--$('#carrier_table').DataTable({
                -- >

                <
                !--dom: 'Bfrtip',
                -- >

                <
                !--buttons: [-- >

                        <
                        !--'copy', 'csv', 'excel', 'pdf', 'print', -- >



                        <
                        !--
                    ]-- >





                    <
                    !--
            });
            -- >

            <
            !--
        });
        -- >

        <
        !--
    </script>-->

    {{-- swal({

	title: "User created!",

	text: "Suceess message sent!!",

	icon: "success",

	button: "Ok",

	timer: 2000

}); --}}


    <script>
        $(document).ready(function() {
            $('#carrier_table66').DataTable({
                dom: 'Blfrtip',
                buttons: [{
                        extend: 'csv',
                        exportOptions: {
                            columns: ':visible'
                        }

                    },
                    'colvis'
                ],
                columnDefs: [{
                    // targets: +0,
                    visible: false
                }]
            });
        });
    </script>

@endsection
