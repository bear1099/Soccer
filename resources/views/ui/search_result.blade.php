@extends('common.layout')
@section('addTitle')
<title>Search Win Matches: Results</title>
@stop
@include('common.header')
@section('addScript')
        <!-- Google Map JavaScript Library -->
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJJb1x_Vypsp3sZA-2uRNaYpj9VnLtyMU"
        type="text/javascript"></script>
        @stop
@section('content')
<div class="container">
<div id="search_form_area">
    <div class="title">Search Matches: Results</div>
    <?php echo $id;?>
    <?php echo "status =" + $status ;?> 
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">TOURNAMENT</th>
                <th scope="col">ROUND</th>
                <th scope="col">GROUP</th>
                <th scope="col">DATE</th>
                <th scope="col">TEAM</th>
                <th scope="col">RESULT</th>
                <th scope="col">TEAM</th>
            </tr>
        </thead>
        <?php foreach ($result as $val) { ?>
            <tr>
                <td scope="row"><?php echo $val->tournament_name; ?></td>
                <td scope="row"><?php echo $val->round_name; ?></td>
                <td scope="row"><?php echo $val->group_name; ?></td>
                <td scope="row"><?php echo $val->date; ?></td>
                <td scope="row"><?php echo $val->team0_name; ?></td>
                <td scope="row"><?php echo $val->outcome; ?></td>
                <td scope="row"><?php echo $val->team1_name; ?></td>
            </tr>
        <?php } ?>
    </table>
    <div id="gmap">
            <div id="mapinfo"></div>
            <div id="map" class="z-depth-1" style="height: 500px"></div>
        </div>
</div>
</div>

<script src="{{ mix('js/search_result.js') }}">
</script>
@stop
@include('common.footer')