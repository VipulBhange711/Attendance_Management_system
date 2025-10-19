@include('include.head')
@include('include.sidebar')
@include('include.navbar')

<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-4"> <a href="#" id="viewSingleAttendance"
                    class="btn border add-btn shadow-none mx-2 d-none d-md-block" data-toggle="modal"
                    data-target="#attendanceModal"><i class="las la-plus mr-2"></i>New Attendance
                </a></div>
            <div class="col-4">
                <button id="viewSelectedEmployees" class="btn btn-info mb-3" disabled>
                    View Selected Employees
                </button>
            </div>
            <div class="col-4">
                <div id="datetime" style="font-size:18px; font-weight:bold; display:flex; align-items:center; gap:8px;">
                    <i id="dayNightIcon" class="fa-solid fa-sun" style="color:orange;"></i>
                    <span id="dateTimeText"></span>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="card mt-5">
                <h3 class="card-header p-3">Employee Attendance</h3>
                <div class="card-body">
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="select_all"></th>
                                <th>No</th>
                                <th>Name</th>
                                <th>Emp ID</th>
                                <th>Pay/Day</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

<!-- Attendance Modal -->
<div class="modal fade" id="attendanceModal" tabindex="-1" role="dialog" aria-labelledby="attendanceModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mark Attendance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="attendanceForm">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Employee</label>
                            <select class="form-control" id="employee_id" name="employee_id" required>
                                <option value="">Select Employee</option>
                                @foreach($employees as $emp)
                                    <option value="{{ $emp->id }}" data-pay="{{ $emp->payperday }}">
                                        {{ $emp->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Pay Per Day</label>
                            <input type="number" id="payperday" name="payperday" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>OT Amount</label>
                            <input type="number" id="ot_amount" name="ot_amount" class="form-control" step="0.01"
                                value="0">
                        </div>

                        <div class="col-md-6">
                            <label>OT Hours</label>
                            <input type="number" id="ot_hours" name="ot_hours" class="form-control" step="0.01"
                                value="0">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Attendance Status</label>
                            <select id="attendance_status" name="attendance_status" class="form-control" required>
                                <option value="">Select Status</option>
                                <option value="Present">Present</option>
                                <option value="Absent">Absent</option>
                                <option value="Holiday">Holiday</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Total Amount</label>
                            <input type="number" id="total_amount" name="total_amount" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-5 offset-7">
                            <button type="submit" class="btn btn-primary">Save Attendance</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Attendance Modal -->

<!-- View Profile -->
<div class="modal fade" id="viewProfile" tabindex="-1" role="dialog" aria-labelledby="attendanceModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Employee ID</label>
                            <input type="text" id="view_Empid" name="" class="form-control" readonly>
                        </div>
                        <div class="col-md-6">
                            <label>Employee Name</label>
                            <input type="text" id="view_EmpName" name="" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="row mb-12">
                        <div class="col-md-4">
                            <label>Pay Per Day</label>
                            <input type="number" id="view_payperday" name="" class="form-control" readonly>
                        </div>
                        <div class="col-md-4">
                            <label>OT Amount</label>
                            <input type="number" id="view_amount" name="" class="form-control" step="0.01" value="0"
                                readonly>
                        </div>

                        <div class="col-md-4">
                            <label>OT Hours</label>
                            <input type="number" id="View_hours" name="" class="form-control" step="0.01" value="0"
                                readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Attendance Status</label>
                            <input type="text" id="view_staus" name="" class="form-control" readonly>
                        </div>

                        <div class="col-md-6">
                            <label>Total Amount</label>
                            <input type="number" id="view_total_amount" name="" class="form-control" readonly>
                        </div>
                    </div>
                </form>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- View Profile -->


<!-- Edit Employee attendance Modal  -->
<div class="modal fade" id="emaployee_atten_editM" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                    <input type="hidden" id="emaployee_atten_id" name="emaployee_atten_id">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Employee</label>
                            <input type="text" id="employee_id_name" name="emaployee_atten_name" class="form-control"
                                readonly>
                        </div>

                        <div class="col-md-6">
                            <label>Pay Per Day</label>
                            <input type="number" id="emaployee_atten_payperday" name="emaployee_atten_payperday"
                                class="form-control" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>OT Amount</label>
                            <input type="number" id="emaployee_atten_ot_amount" name="emaployee_atten_ot_amount"
                                class="form-control" step="0.01" value="0">
                        </div>

                        <div class="col-md-6">
                            <label>OT Hours</label>
                            <input type="number" id="emaployee_atten_ot_hours" name="emaployee_atten_ot_hours"
                                class="form-control" step="0.01" value="0">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Attendance Status</label>
                            <select id="Edit_attendance_status" name="attendance_status" class="form-control" required>
                                <option value="">Select Status</option>
                                <option value="Present">Present</option>
                                <option value="Absent">Absent</option>
                                <option value="Holiday">Holiday</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Total Amount</label>
                            <input type="number" id="emaployee_atten_total_amount" name="emaployee_atten_total_amount"
                                class="form-control" readonly>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="EditUpdateEmployee" class="btn btn-primary">Save Employee</button>
            </div>
        </div>
    </div>
</div>
<!-- Edit Employee attendance Modal -->


<!-- Bulk Edit Modal -->
<div class="modal fade" id="bulkEditAttendanceModal" tabindex="-1" role="dialog" aria-labelledby="bulkEditModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Attendance for Selected Employees</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="bulkAttendanceForm">
                    @csrf
                    <table class="table table-bordered" id="bulkAttendanceTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Emp ID</th>
                                <th>Pay/Day</th>
                                <th>OT Amount</th>
                                <th>OT Hours</th>
                                <th>Attendance Status</th>
                                <th>Total Amount</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="saveBulkAttendance" class="btn btn-primary">Save All</button>
            </div>
        </div>
    </div>
</div>
<!-- Bulk Edit Modal -->



@include('include.footer')


<script>
    $(document).ready(function () {
        $(function () {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('Attendance.index') }}",
                columns: [
                    {
                        data: 'id',
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row) {
                            return `<input type="checkbox" class="employee_checkbox" value="${data}" data-row='${JSON.stringify(row)}'>`;
                        }
                    },
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'empid', name: 'empid' },
                    { data: 'payperday', name: 'payperday' },
                    { data: 'status', name: 'status', orderable: false, searchable: false },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row) {
                            return `
                        <a href="#" 
                           data-toggle="modal" 
                           data-target="#emaployee_atten_editM" 
                           onclick='editemployeeattendance(${JSON.stringify(row)})' 
                           class="edit btn btn-primary btn-sm me-1">Update</a>
                        <a href="#" 
                           data-toggle="modal" 
                           data-target="#viewProfile" 
                           onclick='viewemployeeattendance(${JSON.stringify(row)})' 
                           class="delete btn btn-danger btn-sm">View</a>
                    `;
                        }
                    }
                ]
            });

            // Select/Deselect All
            $('#select_all').on('click', function () {
                $('.employee_checkbox').prop('checked', this.checked);
                toggleViewSelectedButton();
            });

            $(document).on('change', '.employee_checkbox', function () {
                if (!this.checked) {
                    $('#select_all').prop('checked', false);
                }
                toggleViewSelectedButton();
            });

            function toggleViewSelectedButton() {
                let anyChecked = $('.employee_checkbox:checked').length > 0;
                $('#viewSelectedEmployees').prop('disabled', !anyChecked);
                $('#viewSingleAttendance').prop('disabled', anyChecked);
            }
        });
        $('#saveBulkAttendance').on('click', function () {
            $.ajax({
                url: "{{ route('attendance.bulkUpdate') }}",
                method: "POST",
                data: $('#bulkAttendanceForm').serialize(),
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Attendance updated for selected employees!',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        });
                        $('#bulkEditAttendanceModal').modal('hide');
                        $('.data-table').DataTable().ajax.reload();
                    }
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                    alert('Error updating attendance!');
                }
            });
        });

// bulk save and select start
        $('#viewSelectedEmployees').on('click', function () {
            let selectedRows = [];
            $('.employee_checkbox:checked').each(function () {
                let row = JSON.parse($(this).attr('data-row'));
                selectedRows.push(row);
            });

            let tbody = '';
            selectedRows.forEach((row, index) => {
                tbody += `<tr>
            <td>${index + 1}</td>
            <td>${row.name}<input type="hidden" name="employee_id[]" value="${row.id}"></td>
            <td>${row.empid}</td>
            <td class="pay">${row.payperday}</td>
            <td><input type="number" class="form-control ot_amount" name="ot_amount[]" value="${row.ot_amount || 0}" step="0.01"></td>
            <td><input type="number" class="form-control ot_hours" name="ot_hours[]" value="${row.ot_hours || 0}" step="0.01"></td>
            <td>
                <select class="form-control attendance_status" name="attendance_status[]">
                    <option value="Present" ${row.attendance_status == 'Present' ? 'selected' : ''}>Present</option>
                    <option value="Absent" ${row.attendance_status == 'Absent' ? 'selected' : ''}>Absent</option>
                    <option value="Holiday" ${row.attendance_status == 'Holiday' ? 'selected' : ''}>Holiday</option>
                </select>
            </td>
            <td><input type="number" class="form-control total_amount" name="total_amount[]" value="${row.total_amount || row.payperday}" readonly></td>
        </tr>`;
            });

            $('#bulkAttendanceTable tbody').html(tbody);
            $('#bulkEditAttendanceModal').modal('show');

            // re-calculate total
            function recalcTotal(row) {
                let pay = parseFloat(row.find('.pay').text()) || 0;
                let ot_amount = parseFloat(row.find('.ot_amount').val()) || 0;
                let ot_hours = parseFloat(row.find('.ot_hours').val()) || 0;
                let status = row.find('.attendance_status').val();
                let total = (status === 'Absent' || status === 'Holiday')
                    ? 0
                    : pay + (ot_amount * ot_hours);
                row.find('.total_amount').val(total.toFixed(2));
            }
            $('#bulkAttendanceTable').off('input').on('input', '.ot_amount, .ot_hours', function () {
                let row = $(this).closest('tr');
                recalcTotal(row);
            });

            $('#bulkAttendanceTable').off('change').on('change', '.attendance_status', function () {
                let row = $(this).closest('tr');
                let status = $(this).val();
                if (status === 'Absent' || status === 'Holiday') {
                    row.find('.ot_amount, .ot_hours').val(0).prop('disabled', true);
                } else {
                    row.find('.ot_amount, .ot_hours').prop('disabled', false);
                }
                recalcTotal(row);
            });

            $('#bulkAttendanceTable .attendance_status').each(function () {
                let row = $(this).closest('tr');
                let status = $(this).val();

                if (status === 'Absent' || status === 'Holiday') {
                    row.find('.ot_amount, .ot_hours').prop('disabled', true);
                }
            });
        });
// bulk save and select End 

        $('#employee_id').change(function () {
            let pay = $('option:selected', this).data('pay');
            $('#payperday').val(pay);
            calculateTotal();
        });

        // calculate total 
        $('#attendance_status').on('change', function () {
            let status = $(this).val();
            if (status === 'Absent' || status === 'Holiday') {
                $('#ot_amount, #ot_hours').prop('disabled', true).val(0);
            } else {
                $('#ot_amount, #ot_hours').prop('disabled', false);
            }
            calculateTotal();
        });

        function calculateTotal() {
            let pay = parseFloat($('#payperday').val()) || 0;
            let ot_amount = parseFloat($('#ot_amount').val()) || 0;
            let ot_hours = parseFloat($('#ot_hours').val()) || 0;
            let status = $('#attendance_status').val();
            let total = (status === 'Absent' || status === 'Holiday') ? 0 : pay + (ot_amount * ot_hours);
            $('#total_amount').val(total.toFixed(2));
        }

        // ajax submit
        $('#attendanceForm').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('attendance.store') }}",
                method: "POST",
                data: $(this).serialize(),
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Attendance marked successfully!',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        });
                        $('#attendanceForm')[0].reset();
                        $('#attendanceModal').modal('hide');
                        $('.data-table').DataTable().ajax.reload();
                    }
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                    alert('Error saving attendance!');
                }
            });
        });
    });

//update employee attendance-start

    function editemployeeattendance(data) {
        $("#emaployee_atten_id").val(data.id);
        $("#employee_id_name").val(data.name);
        $('#emaployee_atten_payperday').val(data.payperday);

        $("#emaployee_atten_ot_amount").val(0).prop('disabled', false);
        $("#emaployee_atten_ot_hours").val(0).prop('disabled', false);
        $("#emaployee_atten_total_amount").val(data.payperday);
        $('#emaployee_atten_ot_amount, #emaployee_atten_ot_hours').off('input').on('input', calculateTotal);
        $('#Edit_attendance_status').off('change').on('change', function () {
            let status = $(this).val();
            if (status === 'Absent' || status === 'Holiday') {
                $('#emaployee_atten_ot_amount, #emaployee_atten_ot_hours').val(0).prop('disabled', true);
            } else {
                $('#emaployee_atten_ot_amount, #emaployee_atten_ot_hours').prop('disabled', false);
            }
            calculateTotal();
        });

        $('#Edit_attendance_status').trigger('change');

        function calculateTotal() {
            let pay = parseFloat($('#emaployee_atten_payperday').val()) || 0;
            let ot_amount = parseFloat($('#emaployee_atten_ot_amount').val()) || 0;
            let ot_hours = parseFloat($('#emaployee_atten_ot_hours').val()) || 0;
            let status = $('#Edit_attendance_status').val();
            let total = (status === 'Absent' || status === 'Holiday') ? 0 : pay + (ot_amount * ot_hours);
            $('#emaployee_atten_total_amount').val(total.toFixed(2));
        }
    }
    //update employee attendance-end

    $('#EditUpdateEmployee').on('click', function (e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('attendance.update') }}",
            method: "POST",
            data: $('#employeeEditForm').serialize(),
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Attendance updated successfully!',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    });
                    $('#emaployee_atten_editM').modal('hide');
                    $('#employeeEditForm')[0].reset();
                    $('.data-table').DataTable().ajax.reload();
                }
            },
            error: function (xhr) {
                console.log(xhr.responseText);
                Swal.fire({
                    title: 'Error!',
                    text: 'Something went wrong while saving attendance!',
                    icon: 'error'
                });
            }
        });
    });

    //view employee attendance 

    function viewemployeeattendance(data) {
        console.log(data);
        $("#view_EmpName").val(data.name);
        $("#view_Empid").val(data.empid);
        $("#view_payperday").val(data.payperday);
        $("#view_amount").val(data.ot_amount);
        $("#View_hours").val(data.ot_hours);
        $("#view_staus").val(data.attendance_status);
        $("#view_total_amount").val(data.total_amount);
    }

    // live date and time 
    function updateDateTime() {
        const now = new Date();
        const date = now.toLocaleDateString('en-GB');
        const time = now.toLocaleTimeString();
        $('#dateTimeText').text(`${date} | ${time}`);
        const hour = now.getHours();
        if (hour >= 6 && hour < 18) {
            $('#dayNightIcon')
                .removeClass('fa-moon')
                .addClass('fa-sun')
                .css('color', 'orange');
        } else {
            $('#dayNightIcon')
                .removeClass('fa-sun')
                .addClass('fa-moon')
                .css('color', '#0dcaf0');
        }
    }
    updateDateTime();
    setInterval(updateDateTime, 1000);
</script>