@include('include.head')
@include('include.sidebar')
@include('include.navbar')

<div class="content-page">
    <div class="container-fluid">

        <a href="#" class="btn border add-btn shadow-none mx-2 d-none d-md-block" data-toggle="modal"
            data-target="#exampleModal"><i class="las la-plus mr-2"></i>New Attendance
        </a>

       
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
                <input type="number" id="ot_amount" name="ot_amount" class="form-control" step="0.01" value="0">
            </div>

            <div class="col-md-6">
                <label>OT Hours</label>
                <input type="number" id="ot_hours" name="ot_hours" class="form-control" step="0.01" value="0">
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

        <button type="submit" class="btn btn-primary">Save Attendance</button>
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


@include('include.footer')


<script>
$(document).ready(function() {

    $('#employee_id').change(function() {
        let pay = $('option:selected', this).data('pay');
        $('#payperday').val(pay);
        calculateTotal();
    });

    $('#ot_amount, #ot_hours').on('input', function() {
        calculateTotal();
    });

    function calculateTotal() {
        let pay = parseFloat($('#payperday').val()) || 0;
        let ot_amount = parseFloat($('#ot_amount').val()) || 0;
        let ot_hours = parseFloat($('#ot_hours').val()) || 0;
        let total = pay + (ot_amount * ot_hours);
        $('#total_amount').val(total.toFixed(2));
    }

    $('#attendanceForm').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: "{{ route('attendance.store') }}",
            method: "POST",
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Attendance marked successfully!',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    });
                    $('#attendanceForm')[0].reset();
                }
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                alert('Error saving attendance!');
            }
        });
    });
});
</script>
