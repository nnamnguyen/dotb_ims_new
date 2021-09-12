//Created by Tuan Anh to handle fields address
gmaps = {
    displayMap: function (address) {
        var url = 'https://maps.google.it/maps/place/' + address;
        window.open(url, '', 500, 500)
    },
    // init auto complete place
    // params:
    // addressField: input
    // componentFields: list of field need to copy
    initAutocomplete: function (addressField, componentFields) {

        // Init auto complete
        var autocomplete = new google.maps.places.Autocomplete(addressField[0]);
        // listener even input change
        google.maps.event.addListener(autocomplete, 'place_changed', () => {
            var place = autocomplete.getPlace();

            // trigger change for save bean
            addressField.val(place.formatted_address).trigger("change");

            // Then fill component fields if any
            if (componentFields) {
                this.copyFields(place, addressField, componentFields);
            }
        });

    },

    // copy address component of place to componentFields
    copyFields: function (place, addressField, componentFields) {

        // Map of component name and type of address component of place
        var mapping = {
            administrative_area_level_1: componentFields.city,
            administrative_area_level_2: componentFields.state,
            country: componentFields.country
        };

        // Remove all current value of componentfields
        Object.values(componentFields).forEach(function (field) {
            field.val('');
        });
        var ward = place.formatted_address.split(', ').join('');

        // Then fill data into component fields
        for (var i = 0; i < place.address_components.length; i++) {
            var component = place.address_components[i].types[0];
            var value = place.address_components[i]['long_name'];
            ward = ward.replace(place.address_components[i]['long_name'], '');
            ward = ward.replace(place.address_components[i]['short_name'], '');
            if (mapping[component]) {
                var field = mapping[component];
                //trigger change for save bean of lumia
                field.val(value).trigger("change");
            }

        }
        //fill latitude and longitude
        componentFields.latitude.val(place.geometry.location.lat()).trigger("change");
        componentFields.longitude.val(place.geometry.location.lng()).trigger("change");

        componentFields.ward.val(ward.trim()).trigger("change");
    }
};

