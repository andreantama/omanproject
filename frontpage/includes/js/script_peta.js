/* GOOGLE MAPS API */
window.google = window.google || {};
google.maps = google.maps || {};
(function() {
  
  function getScript(src) {
    document.write('<' + 'script src="' + src + '"' +
                   ' type="text/javascript"><' + '/script>');
  }
  
  var modules = google.maps.modules = {};
  google.maps.__gjsload__ = function(name, text) {
    modules[name] = text;
  };
  
  google.maps.Load = function(apiLoad) {
    delete google.maps.Load;
    apiLoad([0.009999999776482582,[[["https://mts0.googleapis.com/vt?lyrs=m@218000000\u0026src=api\u0026hl=en-US\u0026","https://mts1.googleapis.com/vt?lyrs=m@218000000\u0026src=api\u0026hl=en-US\u0026"],null,null,null,null,"m@218000000"],[["https://khms0.googleapis.com/kh?v=130\u0026hl=en-US\u0026","https://khms1.googleapis.com/kh?v=130\u0026hl=en-US\u0026"],null,null,null,1,"130"],[["https://mts0.googleapis.com/vt?lyrs=h@218000000\u0026src=api\u0026hl=en-US\u0026","https://mts1.googleapis.com/vt?lyrs=h@218000000\u0026src=api\u0026hl=en-US\u0026"],null,null,"imgtp=png32\u0026",null,"h@218000000"],[["https://mts0.googleapis.com/vt?lyrs=t@131,r@218000000\u0026src=api\u0026hl=en-US\u0026","https://mts1.googleapis.com/vt?lyrs=t@131,r@218000000\u0026src=api\u0026hl=en-US\u0026"],null,null,null,null,"t@131,r@218000000"],null,null,[["https://cbks0.googleapis.com/cbk?","https://cbks1.googleapis.com/cbk?"]],[["https://khms0.googleapis.com/kh?v=76\u0026hl=en-US\u0026","https://khms1.googleapis.com/kh?v=76\u0026hl=en-US\u0026"],null,null,null,null,"76"],[["https://mts0.googleapis.com/mapslt?hl=en-US\u0026","https://mts1.googleapis.com/mapslt?hl=en-US\u0026"]],[["https://mts0.googleapis.com/mapslt/ft?hl=en-US\u0026","https://mts1.googleapis.com/mapslt/ft?hl=en-US\u0026"]],[["https://mts0.googleapis.com/vt?hl=en-US\u0026","https://mts1.googleapis.com/vt?hl=en-US\u0026"]],[["https://mts0.googleapis.com/mapslt/loom?hl=en-US\u0026","https://mts1.googleapis.com/mapslt/loom?hl=en-US\u0026"]],[["https://mts0.googleapis.com/mapslt?hl=en-US\u0026","https://mts1.googleapis.com/mapslt?hl=en-US\u0026"]],[["https://mts0.googleapis.com/mapslt/ft?hl=en-US\u0026","https://mts1.googleapis.com/mapslt/ft?hl=en-US\u0026"]]],["en-US","US",null,0,null,null,"https://maps.gstatic.com/mapfiles/","https://csi.gstatic.com","https://maps.googleapis.com","https://maps.googleapis.com"],["https://maps.gstatic.com/intl/en_us/mapfiles/api-3/13/2","3.13.2"],[348155197],1.0,null,null,null,null,0,"",["places"],null,1,"https://khms.googleapis.com/mz?v=130\u0026",null,"https://earthbuilder.googleapis.com","https://earthbuilder.googleapis.com",null,"https://mts.googleapis.com/vt/icon"], loadScriptTime);
  };
  var loadScriptTime = (new Date).getTime();
  //getScript("https://maps.gstatic.com/cat_js/intl/en_us/mapfiles/api-3/13/2/%7Bmain,places%7D.js");
  getScript("http://maps.googleapis.com/maps/api/js?v=3&sensor=false&callback=initialize");
})();


var province = null;
var schoolLocation = new Array();
var schoolLocationGroup = new Array();
var schools = null;
$(document).ready(function(){
	
	
	$.ajax({
		url: APP_DOMAIN + '/' + PREFIX + '/' + 'api/location',
		type: 'get',
		dataType: 'json',
		error: function(){
			alert('Connection Error, please try again later');
		},
		success: function(response){
			if(response.success){
				province = response.data.province;
				
				schools = response.data.school;
				
				var schoolLength = response.data.schoolLocation.length;
				
				for(var i=0; i<schoolLength; i++){
					schoolLocation[response.data.schoolLocation[i].Id] = response.data.schoolLocation[i];
					if(isEmpty(schoolLocationGroup[response.data.schoolLocation[i].MapProvinceId])){
						schoolLocationGroup[response.data.schoolLocation[i].MapProvinceId] = new Array();
					}
					schoolLocationGroup[response.data.schoolLocation[i].MapProvinceId].push(response.data.schoolLocation[i]);	
					//schoolLocationGroup[response.data.schoolLocation[i].MapProvinceId][response.data.schoolLocation[i].Id] = response.data.schoolLocation[i]
					
					
				}
				initialize();
				//google.maps.event.addDomListener(window, 'load', initialize);
				generateFilter();
			}
		}
	});
});



function isEmpty(val){
    return (val === undefined || val == null || val.length <= 0) ? true : false;
}

function generateFilter(){
	var provinceLength = province.length;
	var html = '<option></option>';
	for(var i=0; i<provinceLength; i++){
		html += '<option value="' + province[i].Id + '">' + province[i].Name + '</option>';
	}
	
	$('select[name=location]').html(html).change(function(){
		var thisId= $(this).val();
		if(thisId == 0){
			return;
		}
		var schoolLength = schoolLocationGroup[thisId].length;
		var html = '';
		for(var i=0; i<schoolLength; i++){
			html += '<option value="' + schoolLocationGroup[thisId][i].Id + '">' + schoolLocationGroup[thisId][i].Name + '</option>';
		}
		$('select[name=school]').html(html);
	});;
	
	$(document).on('submit', 'form[name=search-school]', function(){
		var id = $(this.school).val();
		var thisMarker = schoolMarker[id].marker;
		map.setCenter(thisMarker.getPosition());
		markerShow(thisMarker, thisMarker.index);
		if(map.getZoom() < 12){
			map.setZoom(12);
		}
		showSchool(id);
	});
}

function showSchool(locationId){
	var schoolLength = schools[locationId].length;
	var html = '';
	for(var i=0, n=1; i<schoolLength; i++, n++){
		html += '<div class="item">';
			html += '<div class="float-left number">' + n + '.</div>';
			html += '<div class="float-left image"><img src="' + ASSETS_BASE + 'maps/' + schools[locationId][i].Image + '" width="65" height="65" /></div>';
			html += '<div class="float-left desc">';
				html += '<h2>' + schools[locationId][i].Name + '</h2>';
				html += '<p class="address-caption">Alamat : </p>';
				html += '<p>' + schools[locationId][i].Address + '</p>';
			html += '</div>';
			if(schools[locationId][i].Website != ''){
				html += '<div class="float-left link">';
					html += '<a class="button" target="_blank" href="' + schools[locationId][i].Website + '">Visit Website</a>';
				html += '</div>';
				}
			else
				{
				html += '<div class="float-left link not-available">';
					html += '<a class="button button2" target="_blank">Website Not Available</a>';
				html += '</div>';
				}
			html += '<div class="clear"></div>';
		html += '</div>';
	}
	console.log('All');
	console.log(html);
	$('#map-container .school-list').html(html);
}
var a = new Array('b', 'c');
var markerIconDefault = IMAGE_BASE + 'pointer-red.png';
var schoolMarker = new Array();

var markerBefore = null;

var map;


function markerShow(marker, index){
	markerHide();
	marker.setIcon(ASSETS_BASE + 'maps/' + schoolLocation[index].Image);
	
	markerBefore = index;
}

function markerHide(){
	var schoolLength = schoolLocation.length;
	for(var i=0; i<schoolLength; i++){
		if(!isEmpty(schoolMarker[i])){
			schoolMarker[i].marker.setIcon(markerIconDefault);
		}
	}
}

function initialize() {
	console.log(google.maps.LatLng);
	var indonesiaLocation = new google.maps.LatLng(-3.493926, 121.982422);
	
	var mapOptions = {
		zoom: 4,
		center: indonesiaLocation,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	
	var schoolLength = schoolLocation.length;
	for(var i=0; i<schoolLength; i++){
		if(!isEmpty(schoolLocation[i])){
			schoolMarker[i] = {
				location: '',
				markerIcon: '',
				marker: '',
				markerDetailIcon: '',
				markerDetail: ''
			};
			schoolMarker[i].location = new google.maps.LatLng(schoolLocation[i].Latitude, schoolLocation[i].Longtitude);
			schoolMarker[i].markerIcon = {
				url: markerIconDefault,
				size: new google.maps.Size(27, 23),
				origin: new google.maps.Point(0, 0),
				anchor: new google.maps.Point(13, 11)
			};
			schoolMarker[i].marker = new google.maps.Marker({
				icon: schoolMarker[i].markerIcon,
				map: map,
				title: schoolLocation[i].Name,
				position: schoolMarker[i].location,
				index: i
			});
			
			google.maps.event.addListener(schoolMarker[i].marker, 'click', function() {
				if(map.getZoom() < 12){
					map.setZoom(12);
				}
				
				map.setCenter(this.getPosition());
				markerShow(this, this.index);

			});
		}
	}
}