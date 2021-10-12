// This sample uses the Places Autocomplete widget to:
// 1. Help the user select a place
// 2. Retrieve the address components associated with that place
// 3. Populate the form fields with those address components.
// This sample requires the Places library, Maps JavaScript API.
// Include the libraries=places parameter when you first load the API.
// For example: <script
// src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
let autocomplete;
let address1Field;
let address2Field;
let postalField;
function dddd(){
    initAutocomplete();
   
}
function initAutocomplete() {
 
  address1Field = document.querySelector("#ship-address");
  address1Field1 = document.querySelector("#ship-address1");
  // postalField = document.querySelector("#postcode");

  autocomplete1 = new google.maps.places.Autocomplete(address1Field1, {
    // componentRestrictions: { country: ["pk", "ca"] },
    // fields: ["address_/components", "geometry"],
    // types: ["address"],
  });
  autocomplete1.addListener("place_changed", fillInAddress);
}

function fillInAddress() {

  Livewire.emit('getAddress', address1Field1.value);
}
