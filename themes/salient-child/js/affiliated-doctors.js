var DoctorSearch = function(container) {

	// Variables
	this.geocoder = new google.maps.Geocoder();
	this.directionsService = new google.maps.DirectionsService();
	this.directionsRenderer = new google.maps.DirectionsRenderer();
	this.startingLatitude = 40.5368874;
	this.startingLongitude = -111.89202899999998;
	this.requestsPending = 0;
	this.searchCenter;
	this.searchCircle;
	this.doctors = [];
	this.activeDoctor;
	this.lastAddress = "";

	// Elements
	this.container = jQuery(container);
	this.shade = jQuery('<div class="affiliated-doctors-shade"></div>');
	this.spinner = jQuery('<div class="affiliated-doctors-spinner"></div>');
	jQuery('body').append(this.shade);
	jQuery('body').append(this.spinner);
	this.mapElement = this.container.find('#map-canvas');
	this.destinationInfo = this.container.find('.destination-info');
	this.directionsPanel = this.container.find('.directions-panel');
	this.markerImage = this.mapElement.attr('data-marker');
	this.form = this.container.find('form');
    this.searchType = this.form.find('#affiliated-doctors-searchby-input');
	this.zipInput = this.form.find('#affiliated-doctors-zip-input');
	this.radiusInput = this.form.find('#affiliated-doctors-radius-input');
	this.refreshButton = this.form.find('.btn.refresh');
	this.printButton = this.form.find('.print-directions-button');
	this.doctorElements = this.container.find('.listing .doctor');
	this.scrollContainer = this.container.find('.listing .scroll-container');
	this.scrollBar = jQuery('<div class="listing-scroll-bar"></div>');
	jQuery('.map .listing').append(this.scrollBar);

	// Functions
	this.collectDoctors = function() {
		for (var i = 0; i < this.doctorElements.length; ++i) {
			var elem = jQuery(this.doctorElements[i]);
			var doctor = {
				name: elem.attr('data-name'),
				practice: elem.attr('data-practice'),
				location: elem.attr('data-location'),
				number: elem.attr('data-number'),
				uri: elem.attr('data-uri'),
				latitude: elem.attr('data-latitude'),
				longitude: elem.attr('data-longitude'),
				element: elem
			};
			elem.click(this.selectDoctor.bind(this, doctor));
			this.doctors.push(doctor);
		}
	};

	this.initMap = function() {
		this.map = new google.maps.Map(document.getElementById('map-canvas'), {
			scrollwheel: false,
			zoom: 6,
			center: new google.maps.LatLng(this.startingLatitude, this.startingLongitude),
			styles: [{"featureType":"all","elementType":"all","stylers":[{"hue":"#00c6ff"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-70},{"hue":"#00ffd0"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"visibility":"simplified"},{"saturation":-60},{"color":"#bde3ee"}]}]
		});
		this.directionsRenderer.setMap(this.map);
		for (var i = 0; i < this.doctors.length; ++i) {
			var doctor = this.doctors[i];
			doctor.pin = new google.maps.Marker({
				animation: google.maps.Animation.DROP,
				position: new google.maps.LatLng(doctor.latitude, doctor.longitude),
				map: this.map,
				title: doctor.name,
				icon: this.markerImage
			});
			google.maps.event.addListener(doctor.pin, 'click', this.selectDoctor.bind(this));
			var infoContent = '<div class="google-maps-infowindow" style="overflow: hidden;"><h4>' + doctor.name + '</h4><p>' + doctor.practice + '</p><p>' + doctor.location + '</p><p>' + doctor.number + '</p><p><a target="_blank" href="' + doctor.uri + '">' + doctor.uri + '</a></p><p></p><p><a href="#" class="google-maps-directions-button" data-latitude="' + doctor.latitude + '" data-longitude="' + doctor.longitude + '">Get Directions</a></p></div>';
			doctor.infoWindow = new google.maps.InfoWindow({ content: infoContent });
		}
	};

	this.addRequest = function() {
		++this.requestsPending;
		if (this.requestsPending > 0) {
			this.shade.css('display', 'block');
			this.spinner.css('display', 'block');
		}
	};

	this.removeRequest = function() {
		--this.requestsPending;
		if (this.requestsPending <= 0) {
			this.requestsPending = 0;
			this.spinner.css('display', 'none');
			this.shade.css('display', 'none');
		}
	};

	this.validateInputs = function() {
		var zip = this.zipInput.val();
		var radius = this.radiusInput.val();
		var pattern = /[^\d]/;
		(zip.match(pattern) || zip.length !== 5) ? this.zipInput.parent('label').addClass('error') : this.zipInput.parent('label').removeClass('error');
		(radius.match(pattern)) ? this.radiusInput.parent('label').addClass('error') : this.zipInput.parent('label').removeClass('error');
		return (!this.zipInput.hasClass('error') && !this.radiusInput.hasClass('error'));
	};

	this.drawCircle = function() {
		var zip = this.zipInput.val();
		var radius = this.radiusInput.val();
		this.geocoder.geocode({ address: zip }, function(response) {
            if(jQuery.isEmptyObject(response)) {
				if(zip !== ""){alert('No results found for ' + zip);}
				this.resetMap();
				this.removeRequest();
            } else {
                this.removeRequest();
                this.searchCenter = response[0].geometry.location;
                this.map.setCenter(this.searchCenter);
                if (this.searchCircle) { this.searchCircle.setMap(null); this.searchCircle = null; }
                var meterRadius = Math.ceil(radius * 1609.34);
                this.searchCircle = new google.maps.Circle({
                    strokeColor: '#3fb9c1',
                    strokeOpacity: 0.8,
                    strokeWeight: 2,
                    fillColor: '#3fb9c1',
                    fillOpacity: 0.35,
                    map: this.map,
                    center: this.searchCenter,
                    radius: meterRadius
                });
                switch (parseInt(radius)) {
                    case 10:
                        this.map.setZoom(11);
                        break;
                    case 15:
                        this.map.setZoom(10);
                        break;
                    case 25:
                    case 50:
                        this.map.setZoom(9);
                        break;
                    default:
                        this.map.setZoom(12);
                        break;
                }

                var bounds = this.searchCircle.getBounds();
                for (var i = 0; i < this.doctors.length; ++i) {
                    if (bounds.contains(this.doctors[i].pin.position)) {
                        this.doctors[i].pin.setOpacity(1);
                        this.doctors[i].element.removeClass('ghost');
                    } else {
                        this.doctors[i].pin.setOpacity(0.4);
                        this.doctors[i].element.removeClass('active');
                        this.doctors[i].element.addClass('ghost');
                    }
                }
            }
		}.bind(this));
	};

    this.sanitizeInput = function(str) {
        return str.replace(/\w\S*/g, function(txt) {
            return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
        });
   };

    this.searchByName = function() {
        var query = this.zipInput.val();
        query = this.sanitizeInput(query);
        query = query.toString().trim();
        var selector = "[data-name*='" + query + "']";
        var matchingDrs = document.querySelectorAll(selector);
        var matchingNames = [];
        for(var i=0; i < matchingDrs.length; ++i) {
            matchingNames.push(matchingDrs[i].getAttribute('data-name'));
        }

        if(matchingNames.length === 0) {
        	if(query !== ""){alert('No results found for ' + query);}
			this.resetMap();
        } else {
            for (var j=0; j < this.doctors.length; ++j) {
                if (matchingNames.indexOf(this.doctors[j].name) !== -1) {
                    this.doctors[j].pin.setOpacity(1);
                    this.doctors[j].element.removeClass('ghost');
                } else {
                    this.doctors[j].pin.setOpacity(0.4);
                    this.doctors[j].element.removeClass('active');
                    this.doctors[j].element.addClass('ghost');
                }
            }
        }

        this.removeRequest();

    };

	this.updateResults = function(e) {
		if (e.preventDefault) { e.preventDefault(); }
		if (!this.validateInputs()) { return false; }
		this.addRequest();

        var searchType = this.searchType.val();
        if(searchType === 'name') {
            this.searchByName();
        } else {
		    this.drawCircle();
        }
		this.scrollListing({type:"slide"},{value:100});
		this.scrollBar.slider({ value: 100 });
		return false;
	};

	this.selectDoctor = function(e) {
		this.printButton.addClass('inactive');
		this.directionsPanel.empty();
		if (e.latLng) { // Pin was clicked
			for (var i = 0; i < this.doctors.length; ++i) {
				if (this.doctors[i].pin.position === e.latLng) {
					this.activeDoctor = this.doctors[i];
					this.map.setCenter(e.latLng);
					this.doctors[i].infoWindow.open(this.map, this.doctors[i].pin);
					var directionsButton = jQuery(this.mapElement).find('.google-maps-directions-button');
					directionsButton.unbind();
					directionsButton.click(this.getDirections.bind(this));
					this.doctors[i].pin.setOpacity(1);
					this.doctors[i].element.removeClass('ghost');
					this.doctors[i].element.addClass('active');
				} else {
					this.doctors[i].infoWindow.close();
					this.doctors[i].element.removeClass('active');
				}
			}
		} else { // Doctor in list was clicked
			var doctor = e;
			for (var i = 0; i < this.doctors.length; ++i) {
				if (this.doctors[i] === doctor) {
					this.activeDoctor = this.doctors[i];
					var latLng = new google.maps.LatLng(doctor.latitude, doctor.longitude);
					this.map.setCenter(latLng);
					this.doctors[i].infoWindow.open(this.map, this.doctors[i].pin);
					var directionsButton = jQuery(this.mapElement).find('.google-maps-directions-button');
					directionsButton.unbind();
					directionsButton.click(this.getDirections.bind(this));
					this.doctors[i].pin.setOpacity(1);
					this.doctors[i].element.removeClass('ghost');
					this.doctors[i].element.addClass('active');
				} else {
					this.doctors[i].infoWindow.close();
					this.doctors[i].element.removeClass('active');
				}
			}
		}
	};

	this.scrollListing = function(e, ui) {
		if (e.type === 'slide') { // Slider
			var parentHeight = this.scrollContainer.parent().height();
			var offset = (100 - ui.value) / 100;
			var currentMargin = parseInt(this.scrollContainer.css('margin-top'));
			var totalMargin = this.scrollContainer.height() - parentHeight;
			var newMargin = (totalMargin * offset) * -1;
			this.scrollContainer.css('margin-top', newMargin.toString() + 'px');
		} else { // Mousewheel
			if (e.preventDefault) { e.preventDefault(); }
			var parentHeight = this.scrollContainer.parent().height();
			var min = (this.scrollContainer.height() - parentHeight) * -1;
			var max = 0;
			var totalMargin = Math.abs(min);
			var offset = 32 * e.deltaY;
			var currentMargin = parseInt(this.scrollContainer.css('margin-top'));
			var newMargin = currentMargin + offset;
			if (newMargin <= min) { newMargin = min; }
			if (newMargin >= max) { newMargin = max; }
			this.scrollContainer.css('margin-top', newMargin.toString() + 'px');
			// Set the scrollbar position:
			var scrollPosition = 100 - (Math.abs(newMargin / totalMargin) * 100);
			this.scrollBar.slider({ value: scrollPosition });
			return false;
		}
	};

	this.getDirections = function(e) {
		if (e.preventDefault) { e.preventDefault(); }
		var target = jQuery(e.currentTarget);
		var destination = new google.maps.LatLng(target.attr('data-latitude'), target.attr('data-longitude'));
		console.log(jQuery(this.mapElement));
		var directionsButton = jQuery(this.mapElement).find('.google-maps-directions-button');
		directionsButton.css("display", "none");
		var container = directionsButton.parent();
		container.append("<div class='directions-question'>What address are you traveling from?<br /><input class='direction-box' style='width: 100%' value='"+this.lastAddress+"' /><br /><small style='font-size: 0.8em;color: #7d8489'>(Press enter after entering your address)</small></div>");
		var dq = container.find(".directions-question");
		var directionBox = dq.find(".direction-box");
		directionBox.focus();

		directionBox.keypress(function(e){
			if(e.keyCode == 13)
			{
				this.lastAddress = directionBox.attr("value");
				directionsButton.css("display", "");
				dq.remove();
				if (this.lastAddress) {
					this.directionsService.route({
						origin: this.lastAddress,
						destination: destination,
						travelMode: google.maps.TravelMode.DRIVING,
						unitSystem: google.maps.UnitSystem.IMPERIAL
					}, this.displayDirections.bind(this));
				}
			}
		}.bind(this));
		return false;
	};

	this.displayDirections = function(directions, status) {
		switch (status) {
			case 'OK':
				this.printButton.removeClass('inactive');
				this.destinationInfo.html('<p>' + this.activeDoctor.name + '</p><p>' + this.activeDoctor.practice + '</p><p>' + this.activeDoctor.location + '</p><p>' + this.activeDoctor.number + '</p><p>' + this.activeDoctor.uri + '</p>');
				this.directionsRenderer.setDirections(directions);
				this.directionsRenderer.setPanel(this.directionsPanel[0]);
				break;
			case 'NOT_FOUND':
				alert('One of the addresses provided (origin or destination) could not properly be geocoded. Sorry!');
				break;
			case 'ZERO_RESULTS':
				alert('A route could not be calculated between the origin and destination, please try another origin address.');
				break;
			case 'INVALID_REQUEST':
				alert('The request to Google Maps was malformed, please contact us and let us know!');
				break;
			case 'OVER_QUERY_LIMIT':
				alert('We\'re under heavy load right now and could not process the request, please try again later!');
				break;
			case 'REQUEST_DENIED':
				alert('The request to Google Maps was rejected, please contact us and let us know!');
				break;
			case 'UNKNOWN_ERROR':
				alert('Something went wrong with the API request, please try again.');
				break;
			default:
				break;
		}
	};

	this.resetMap = function()
	{
		this.zipInput.val("");
		if (this.searchCircle) { this.searchCircle.setMap(null); this.searchCircle = null; }
		for (var i = 0; i < this.doctors.length; ++i) {
			this.doctors[i].pin.setOpacity(1);
			this.doctors[i].element.removeClass('ghost');
            this.doctors[i].infoWindow.close();
            this.doctors[i].element.removeClass('active');
		}
		this.map.setZoom(6);
		var latLng = new google.maps.LatLng(this.startingLatitude, this.startingLongitude);
		this.map.setCenter(latLng);
        this.printButton.addClass('inactive');
        if (this.lastAddress) { this.lastAddress = ''; }
        if(this.directionsRenderer) {
            this.directionsRenderer.setMap(null);
            this.directionsRenderer.setPanel(null);
            this.directionsRenderer = new google.maps.DirectionsRenderer();
            this.directionsRenderer.setMap(this.map);
        }
        this.destinationInfo.html('');
	}

	this.printDirections = function(e) {
		var target = jQuery(e.target);
		if (target.hasClass('inactive')) { return false; }
		window.print();
	};

	// Actions
	this.collectDoctors();

	// Event Listeners
	this.form.on('submit', this.updateResults.bind(this));
	this.refreshButton.click(this.resetMap.bind(this));
	this.printButton.click(this.printDirections.bind(this));
	this.scrollContainer.on('mousewheel', this.scrollListing.bind(this));
	google.maps.event.addDomListener(window, 'load', this.initMap.bind(this));
	this.scrollBar.slider({
		min: 0,
		max: 100,
		value: 100,
		orientation: 'vertical',
		slide: this.scrollListing.bind(this)
	});

};

jQuery(document).ready(function() {
	var container = jQuery('div.affiliated-doctors-container');
	if (container.length > 0) { new DoctorSearch(container); }
});