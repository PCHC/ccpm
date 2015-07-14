<?php
// WP_Query arguments
$args = array (
	'post_type'              => array( 'member' ),
  'post_status'            => array( 'publish' ),
	'pagination'             => false,
  'post_parent'            => 0,
	'posts_per_page'         => '-1',
	'order'                  => 'ASC',
	'orderby'                => 'title',
);

// The Query
$members = new WP_Query( $args );

// The Loop
if ( $members->have_posts() ) : ?>
  <div class="container">
    <div class="row front-page-map">

    <script type="text/javascript">
      function initialize() {
        var defaultLatlng = new google.maps.LatLng(44.8146956, -68.8086606);
        var mapOptions = {
          center: defaultLatlng,
          zoom: 8
        };

        //https://maps.googleapis.com/maps/api/geocode/json?address=&key=
        var map = new google.maps.Map(document.getElementById('map-canvas-frontpage'), mapOptions);
        setMarkers(map);
      }

      function setMarkers(map){
        var addresses = [<?php while ( $members->have_posts() ) { $members->the_post(); echo "'" . urlencode( types_render_field('address') ) . "',"; } ?>];

        var xmlhttp = new XMLHttpRequest();
        var geoUrl = 'https://maps.googleapis.com/maps/api/geocode/json?address=';
        var geoKey = '<?php echo GOOGLE_SERVER_API_KEY; ?>';

        for (i = 0; i < addresses.length; i++) {
          jQuery.getJSON( geoUrl + addresses[i] + '&key=' + geoKey, function(data){
            var geoMarker = data.results[0];
            var marker = new google.maps.Marker({
              position: new google.maps.LatLng(geoMarker.geometry.location.lat, geoMarker.geometry.location.lng),
              map: map,
              title: 'Hello World!'
            });
          });
        }
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <div id="map-canvas-frontpage" class="map-canvas"></div>
    </div>
  </div>
<?php endif;

// Restore original Post Data
wp_reset_postdata();
?>
