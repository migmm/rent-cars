async function getCities() {
    var countrySelect = document.getElementById("countrySelect");
    var citySelect = document.getElementById("citySelect");

    var selectedCountry = countrySelect.value;

    try {
        var response = await fetch(`utils/getCities.php?country_id=${selectedCountry}`);
        var cities = await response.json();

        citySelect.innerHTML = "";
        for (var i = 0; i < cities.length; i++) {
            var option = document.createElement("option");
            option.value = cities[i].id;
            option.text = cities[i].name;
            citySelect.add(option);
        }
    } catch (error) {
        console.error("Error al obtener ciudades:", error);
    }
}

function previewProfilePicture(event) {
    const input = event.target;
    const preview = document.getElementById('profilePicturePreview');

    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
        };
        reader.readAsDataURL(file);
    } else {
        preview.src = '<?php echo $profile_picture; ?>';
    }
}

function previewCarImages(event) {
    const input = event.target;
    const previewsContainer = document.getElementById('carImagesPreview');

    previewsContainer.innerHTML = '';

    for (const file of input.files) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.alt = 'Car Image';
            img.style.maxWidth = '200px';
            img.style.maxHeight = '200px';
            previewsContainer.appendChild(img);
        };
        reader.readAsDataURL(file);
    }
}

document.addEventListener("DOMContentLoaded", function() {
    getCities();
});

