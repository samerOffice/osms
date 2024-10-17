@extends('master')

@section('title')
Welcome
@endsection

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <br>
      <div class="row">
        <div class="col-12">
          <a class="btn btn-outline-info float-right" href="">
            <i class="fas fa-arrow-left"></i> Back
          </a>
        </div>

        <div class="col-2"></div>

        <div class="col-7">
          <br>
          <!-- Profile Image -->
          <div class="card card-success card-outline">
            <form id="attendanceForm">
              <div class="card-body">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{asset('/dist/img/avatar5.png')}}"
                       alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">{{ auth()->user()->name }}</h3>
                <p class="text-muted text-center">{{$designation->designation_name}}</p>
                <p class="text-muted text-center">{{$branch_details->branch_name}}</p>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Date</b> <a class="float-right">{{ \Carbon\Carbon::now()->format('l, F j, Y') }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Time</b> <a class="float-right">{{ \Carbon\Carbon::now()->format('h:i A') }}</a>
                  </li>
                </ul>
                @if($attendance && $attendance->id)
                <button type="submit" id="submitBtn" class="btn btn-danger float-right"><i class="fa-solid fa-right-from-bracket"></i> Leave</button>
                @else
                <button class="btn btn-danger float-right disabled" disabled>Leave</button>
                @endif

              </div>

              <div id="locationDisplay" class="p-2 text-center">
                Your Current Lat, Long: <span id="currentLat">Latitude: Not available</span> <span id="currentLon">Longitude: Not available</span>
              </div>
            </form>
          </div>
        </div>
      </div>
      <br>

    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

</div>

@endsection

@push('masterScripts')
<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function() {
    function getCsrfToken() {
      return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }

    // Coordinates of the predefined location
    const officeLat = @json($branch_details->branch_latitude); //dynamic latitute
    const officeLon = @json($branch_details->branch_longitude); //dynamic logitude

    // const officeLat = 23.7745978; // Example latitude
    // const officeLon = 90.4219535; // Example longitude

    // Function to calculate distance between two coordinates
    function calculateDistance(lat1, lon1, lat2, lon2) {
      const R = 6371e3; // Radius of the Earth in meters
      const φ1 = lat1 * Math.PI / 180;
      const φ2 = lat2 * Math.PI / 180;
      const Δφ = (lat2 - lat1) * Math.PI / 180;
      const Δλ = (lon2 - lon1) * Math.PI / 180;
      const a = Math.sin(Δφ / 2) * Math.sin(Δφ / 2) +
        Math.cos(φ1) * Math.cos(φ2) *
        Math.sin(Δλ / 2) * Math.sin(Δλ / 2);
      const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
      const d = R * c; // Distance in meters
      return d;
    }

    // Function to display current location and handle form submission
    function handleFormSubmission(position) {
      const userLat = position.coords.latitude;
      const userLon = position.coords.longitude;

      // Log user's current latitude and longitude
      console.log(`Current Latitude: ${userLat}`);
      console.log(`Current Longitude: ${userLon}`);

      // Display latitude and longitude
      document.getElementById('currentLat').textContent = `Latitude: ${userLat}`;
      document.getElementById('currentLon').textContent = `Longitude: ${userLon}`;

      const distance = calculateDistance(userLat, userLon, officeLat, officeLon);

      if (distance <= 100) {
        // Form submission handler
        document.getElementById('attendanceForm').addEventListener('submit', function(event) {
          event.preventDefault();

          var attendanceFormData = new FormData(document.getElementById('attendanceForm'));

          var attendance_id = @json($attendance ? $attendance->id : null);

          axios.defaults.withCredentials = true;
          axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

          console.log('CSRF Token:', getCsrfToken());

          if (attendance_id !== null) {
                axios.get('/sanctum/csrf-cookie').then(() => {
                axios.post('/api/submit_exit_time/'+ attendance_id, attendanceFormData).then(response => {
                console.log(response);

                // $('#attendance_id').val(response.data.attendance_id);

                Swal.fire({
                    icon: "success",
                    title: response.data.message,
                });
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
                }).catch(error => {
                console.error('Submit error:', error.response);
                Swal.fire({
                    icon: "error",
                    title: error.response ? error.response.data.message : 'An error occurred',
                });
                });
            }).catch(error => {
                console.error('CSRF token error:', error);
                Swal.fire({
                icon: "error",
                title: 'CSRF token error',
                });
            });
          }else{
            Swal.fire({
                icon: "error",
                title: "Attendance record not found",
            });
          }

        });
      } else{
        Swal.fire({
          icon: "error",
          title: "You are not within 100 meters of the designated location.",
        });
      }
    }

    // Handle location retrieval and display
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(handleFormSubmission, function(error) {
        console.error('Geolocation error:', error);
        Swal.fire({
          icon: "error",
          title: `Unable to retrieve your location. Error: ${error.message}`,
        });
      });
    } else {
      Swal.fire({
        icon: "error",
        title: "Geolocation is not supported by this browser.",
      });
    }

    // Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });

    // Initialize Summernote
    $('.summernote').summernote();
  });
</script>
@endpush