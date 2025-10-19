@include('include.head')
@include('include.sidebar')
@include('include.navbar')






<div class="content-page">
    <div class="container-fluid">

        <a href="#" class="btn border add-btn shadow-none mx-2 d-none d-md-block" data-toggle="modal"
            data-target="#exampleModal"><i class="las la-plus mr-2"></i>New Employee
        </a>


        <div class="container">
            <div class="card mt-5">
                <h3 class="card-header p-3">Employee List</h3>
                <div class="card-body">
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th width="40%"> Name</th>
                                <th width="250px">Emp ID</th>
                                <th>Pay/Day</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
</div>
</div>
<!-- Add Employee Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="employeeForm">
                    @csrf
                    <div class="form-group">
                        <label for="name">Employee Name</label>
                        <input type="text" class="form-control" name="name"  id="Add_name" required>
                    </div>

                    <div class="form-group">
                        <label for="empid">Employee ID</label>
                        <input type="text" class="form-control" name="empid" id="Add_empid" required>
                    </div>

                    <div class="form-group">
                        <label for="payperday">Pay Per Day</label>
                        <input type="number" class="form-control" name="payperday" id="Add_payperday" step="0.01" required>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="saveEmployee" class="btn btn-primary">Save Employee</button>
            </div>
        </div>
    </div>
</div>
<!-- Add Employee Modal -->

<!-- Edit Employee Modal -->
<div class="modal fade" id="editemployeeM" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="employeeEditForm">
                    @csrf
                    <input type="hidden" id="employee_id">
                    <div class="form-group">
                        <label for="name">Employee Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="empid">Employee ID</label>
                        <input type="text" class="form-control" id="empid" name="empid" required>
                    </div>

                    <div class="form-group">
                        <label for="payperday">Pay Per Day</label>
                        <input type="number" class="form-control" id="payperday" name="payperday" step="0.01" required>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="EditEmployee" class="btn btn-primary">Save Employee</button>
            </div>
        </div>
    </div>
</div>
<!-- edit Employee Modal -->


<!-- Delete Employee Modal -->
<div class="modal fade" id="deleteemployeeM" tabindex="-1" role="dialog" aria-labelledby="deleteEmployeeLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteEmployeeLabel">Delete Employee</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="employeeDeleteForm">
                    @csrf
                    <input type="hidden" id="delete_employee_id" name="id">

                    <p>Are you sure you want to delete this employee?</p>

                    <div class="form-group">
                        <label>Employee Name</label>
                        <input type="text" class="form-control" id="delete_name" readonly>
                    </div>

                    <div class="form-group">
                        <label>Employee ID</label>
                        <input type="text" class="form-control" id="delete_empid" readonly>
                    </div>

                    <div class="form-group">
                        <label>Pay Per Day</label>
                        <input type="number" class="form-control" id="delete_payperday" readonly>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" id="deleteEmployeeBtn" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>
<!-- End Delete Employee Modal -->
@include('include.footer')

<script>
    $(document).ready(function () {

        $(function () {

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('employees.index') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'empid', name: 'empid' },
                    { data: 'payperday', name: 'payperday' },
                    {
                        data: null,  
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row, meta) {
                            return `
                        <a href="#" 
                           data-toggle="modal" 
                           data-target="#editemployeeM" 
                           onclick='editwithid(${JSON.stringify(row)})' 
                           class="edit btn btn-primary btn-sm me-1">Edit</a>

                        <a href="#" 
                         data-toggle="modal" 
                           data-target="#deleteemployeeM" 
                           onclick='deletewithid(${JSON.stringify(row)})' 
                           class="delete btn btn-danger btn-sm">Delete</a>
                    `;
                        }
                    }
                ]
            });

        });

        // add employee
        $('#saveEmployee').click(function (e) {
            e.preventDefault();
            let formData = {
                name: $('#Add_name').val(),
                empid: $('#Add_empid').val(),
                payperday: $('#Add_payperday').val(),
                _token: '{{ csrf_token() }}'
            };

            console.log(formData);
            // return false;

            $.ajax({
                url: "{{ route('employees.store') }}",
                method: "POST",
                data: formData,
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Employee added successfully!',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        });

                        //  Reset the form
                        $('#employeeForm')[0].reset();
                         $('#employeeTable').DataTable().ajax.reload();
                        window.location.reload();

                        setTimeout(() => {
                            $('#exampleModal').modal('hide');
                        }, 12);
                    }
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                    alert('Something went wrong!');
                }
            });
        });
        // add employee

        // edit employee


        $('#EditEmployee').click(function (e) {
            e.preventDefault();

            let formData = {
                id: $('#employee_id').val(),
                name: $('#name').val(),
                empid: $('#empid').val(),
                payperday: $('#payperday').val(),
                _token: '{{ csrf_token() }}'
            };

            // console.log(formData);
            // return false;

            $.ajax({
                url: "{{ route('employees.update') }}",
                method: "POST",
                data: formData,
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Employee Update successfully!',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        });

                        //  Reset the form
                        $('#employeeEditForm')[0].reset();
                        $('#employeeTable').DataTable().ajax.reload();
                        window.location.reload();

                        setTimeout(() => {
                            $('#editemployeeM').modal('hide');
                        }, 12);
                    }
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                    alert('Something went wrong!');
                }
            });
        });
        // edit employee
    });

   function editwithid(data) {
    // console.log(data);
    $('#employee_id').val(data.id);
    $('#name').val(data.name);
    $('#empid').val(data.empid);
    $('#payperday').val(data.payperday);
}
   function deletewithid(data) {
    $('#delete_employee_id').val(data.id);
    $('#delete_name').val(data.name);
    $('#delete_empid').val(data.empid);
    $('#delete_payperday').val(data.payperday);
    $('#deleteemployeeM').modal('show');
}

</script>