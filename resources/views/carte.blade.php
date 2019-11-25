@include('layouts.header')
<form class="form-inline">
        <div class="form-group  mx-sm-3 mb-2">
            <label for="inputPassword2" class="sr-only">Password</label>
            <input type="text" class="form-control shadow" required id="userInput" autocomplete="off" placeholder="Choose a city...and press enter">
        </div>
        <button type="submit" class="btn btn-primary mb-2" id="send">SEND</button>
    </form>

    <div class="row with-map" >
        <div class="col-xs-12 col-sm-12 col-md-6" id="map">
            <div id="my_osm_widget_map"></div>
        </div>
      </div>
@include('layouts.footer')